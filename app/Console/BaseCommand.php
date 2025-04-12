<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class BaseCommand extends Command
{
    protected string $stubContent;

    protected string $outputFilePath;

    protected string $domain;

    protected function createFromStub(array $replaceValues): string
    {
        $this->stubContent = str($this->stubContent)
            ->replace(array_keys($replaceValues), array_values($replaceValues))
            ->value();

        return $this->stubContent;
    }

    protected function createFile()
    {
        (new Filesystem)->put(
            $this->outputFilePath,
            $this->stubContent
        );
    }

    protected function setStubContent(string $stubName): string
    {
        $this->stubContent = (new Filesystem)->get(base_path('stubs/'.$stubName.'.stub'));
        return $this->stubContent;
    }
}
