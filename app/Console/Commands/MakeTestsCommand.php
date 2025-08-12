<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeTestsCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:tests {name}
    {--is-child}
    {--domain}
    {--is-featured-image}
    {--is-filters}
    ';

    protected $description = 'New Tests';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $this->model = $this->argument('name');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use filters?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $replace = [
            "{{ model }}" => $this->model,
            "{{ kebabModel }}" => $modelNames['kebabModel'],
            "{{ snakeModel }}" => $modelNames['snakeModel'],
            "{{ camelModel }}" => $modelNames['camelModel'],
            "{{ camelPluralModel }}" => $modelNames['camelPluralModel'],
            "{{ snakeDomain }}" => $domainNames['snakeDomain'],
            "{{ kebabDomain }}" => $domainNames['kebabDomain'],
            "{{ domain }}" => $this->domain,
            "{{ kebabPluralModel }}" => $modelNames['kebabPluralModel'],
            "{{ langModel }}" => $modelNames['langModel'],
            "{{ kebabModelWithoutDomain }}" => $modelNames['kebabModelWithoutDomain'],
            "{{ databaseModel }}" => $modelNames['databaseModel']
        ];

        if (!File::exists(base_path("tests/Feature/App/$this->domain/"))) {
            File::makeDirectory(base_path("tests/Feature/App/$this->domain"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/Controllers"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/DTOs"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/Services"));
            File::makeDirectory(base_path("tests/RequestFactories/$this->domain"));
            File::makeDirectory(base_path("tests/RequestFactories/$this->domain/Admin"));
        }

        $this->outputFilePath = base_path("tests/RequestFactories/$this->domain/Admin/Create{$this->model}RequestFactory.php");
        $this->setStubContent('tests/request');
        $this->createFromStub($replace);
        $this->createFile();

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Controllers/{$this->model}ControllerTest.php");
        if ($isFeaturedImage) {
            $this->setStubContent('tests/controller-image');
        } else {
            $this->setStubContent('tests/controller');
        }
        $this->createFromStub($replace);
        $this->createFile();

        if ($isFilters) {
            $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Controllers/{$this->model}FilterTest.php");
            $this->setStubContent('tests/filter');
            $this->createFromStub($replace);
            $this->createFile();
        }

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/DTOs/Fill{$this->model}DTOTest.php");
        $this->setStubContent('tests/dto');
        $this->createFromStub($replace);
        $this->createFile();

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Services/{$this->model}ServiceTest.php");
        if ($isFeaturedImage) {
            $this->setStubContent('tests/service-image');
        } else {
            $this->setStubContent('tests/service');
        }
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
