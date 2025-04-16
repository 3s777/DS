<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeQueryBuilderCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:builder {name}
    {--is-child}
    {--domain}
    ';

    protected $description = 'New Query Builder';

    public function handle(): int
    {
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');

        $model = str($name)->ucfirst();
        $namespace = "Domain\\$this->domain\QueryBuilders";

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $model,
        ];

        if(!File::exists(base_path("src/Domain/$this->domain/QueryBuilders"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/QueryBuilders"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/QueryBuilders/{$name}QueryBuilder.php");
        $this->setStubContent('base-admin-query-builder');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
