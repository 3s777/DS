<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeControllerCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:controller {name} {--is-child} {--domain} {--is-mass-delete} {--is-filters}';

    protected $description = 'New Controller';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->model = $this->argument('name');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isMassDelete = $isChild ? $this->option('is-mass-delete') : confirm('Do you need mass deleting?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use Filters?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $namespace = "App\Http\Controllers\\$this->domain\Admin";
        $importFilterRequest = $isFilters ? "use App\Http\Requests\\$this->domain\Admin\Filter{$this->model}Request;" : "";
        $filterRequest = $isFilters ? "Filter{$this->model}Request \$request" : "";

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ kebabModel }}" => $modelNames['kebabModel'],
            "{{ snakeModel }}" => $modelNames['snakeModel'],
            "{{ camelModel }}" => $modelNames['camelModel'],
            "{{ domain }}" => $this->domain,
            "{{ kebabDomain }}" => $domainNames['kebabDomain'],
            "{{ snakeDomain }}" => $domainNames['snakeDomain'],
            "{{ camelDomain }}" => $domainNames['camelDomain'],
            "{{ kebabPluralModel }}" => $modelNames['kebabPluralModel'],
            "{{ langModel }}" => $modelNames['langModel'],
            "{{ kebabModelWithoutDomain }}" => $modelNames['kebabModelWithoutDomain'],
            "{{ importFilterRequest }}" => $importFilterRequest,
            "{{ filterRequest }}" => $filterRequest,
        ];

        $this->outputFilePath = base_path("app/Http/Controllers/$this->domain/Admin/{$this->model}Controller.php");
        if ($isMassDelete) {
            $this->setStubContent('base-admin-controller.mass-delete');
        } else {
            $this->setStubContent('base-admin-controller');
        }

        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
