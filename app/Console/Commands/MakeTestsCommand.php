<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\File;

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
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use filters?');

        $model = str($name)->ucfirst();
        $kebabModel = str($name)->kebab();
        $snakeModel = str($name)->snake();
        $camelModel = str($name)->camel();
        $camelPluralModel = str($name)->pluralStudly()->camel();
        $kebabPluralModel = str($name)->pluralStudly()->kebab();
        $domain = str($this->domain)->ucfirst();
        $snakeDomain = str($this->domain)->snake();
        $kebabDomain = str($this->domain)->kebab();
        $langModel = str($name)->remove($this->domain)->snake();
        $kebabModelWithoutDomain = str($name)->remove($this->domain)->kebab();
        $databaseModel = str($name)->pluralStudly()->snake();

        $replace = [
            "{{ model }}" => $model,
            "{{ kebabModel }}" => $kebabModel,
            "{{ snakeModel }}" => $snakeModel,
            "{{ camelModel }}" => $camelModel,
            "{{ camelPluralModel }}" => $camelPluralModel,
            "{{ snakeDomain }}" => $snakeDomain,
            "{{ kebabDomain }}" => $kebabDomain,
            "{{ domain }}" => $domain,
            "{{ kebabPluralModel }}" => $kebabPluralModel,
            "{{ langModel }}" => $langModel,
            "{{ kebabModelWithoutDomain }}" => $kebabModelWithoutDomain,
            "{{ databaseModel }}" => $databaseModel
        ];

        if(!File::exists(base_path("tests/Feature/App/$this->domain/"))) {
            File::makeDirectory(base_path("tests/Feature/App/$this->domain"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/Controllers"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/DTOs"));
            File::makeDirectory(base_path("tests/Feature/App/$this->domain/Services"));
            File::makeDirectory(base_path("tests/RequestFactories/$this->domain"));
            File::makeDirectory(base_path("tests/RequestFactories/$this->domain/Admin"));
        }

        $this->outputFilePath = base_path("tests/RequestFactories/$this->domain/Admin/Create{$name}RequestFactory.php");
        $this->setStubContent('tests/request');
        $this->createFromStub($replace);
        $this->createFile();

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Controllers/{$name}ControllerTest.php");
        if ($isFeaturedImage) {
            $this->setStubContent('tests/controller-image');
        } else {
            $this->setStubContent('tests/controller');
        }
        $this->createFromStub($replace);
        $this->createFile();

        if($isFilters) {
            $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Controllers/{$name}FilterTest.php");
            $this->setStubContent('tests/filter');
            $this->createFromStub($replace);
            $this->createFile();
        }

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/DTOs/Fill{$name}DTOTest.php");
        $this->setStubContent('tests/dto');
        $this->createFromStub($replace);
        $this->createFile();

        $this->outputFilePath = base_path("tests/Feature/App/$this->domain/Services/{$name}ServiceTest.php");
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
