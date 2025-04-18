<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class BaseCommand extends Command
{
    protected string $stubContent;

    protected string $outputFilePath;

    protected string $domain;

    protected string $model;

    protected function setModelNames(): array
    {
        $this->model = str($this->model)->ucfirst();

        return [
            'kebabModel' => str($this->model)->kebab(),
            'kebabPluralModel' => str($this->model)->pluralStudly()->kebab(),
            'snakeModel' => str($this->model)->snake(),
            'snakePluralModel' => str($this->model)->pluralStudly()->snake(),
            'camelModel' => str($this->model)->camel(),
            'camelPluralModel' => str($this->model)->pluralStudly()->camel(),
            'databaseModel' => str($this->model)->pluralStudly()->snake(),
            'langModel' => str($this->model)->remove($this->domain)->snake(),
            'kebabModelWithoutDomain' => str($this->model)->remove($this->domain)->kebab(),
        ];
    }

    protected function setDomainNames(): array
    {
        $this->domain = str($this->domain)->ucfirst();

        return [
            'kebabDomain' => str($this->domain)->kebab(),
            'kebabPluralDomain' => str($this->domain)->pluralStudly()->kebab(),
            'snakeDomain' => str($this->domain)->snake(),
            'snakePluralDomain' => str($this->domain)->pluralStudly()->snake(),
            'camelDomain' => str($this->domain)->camel(),
            'camelPluralDomain' => str($this->domain)->pluralStudly()->camel(),
            'databaseDomain' => str($this->domain)->pluralStudly()->snake(),
        ];
    }

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
