<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeControllerCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:controller {name} {--is-child} {--domain} {--is-mass-delete}';

    protected $description = 'New Controller';

    public function handle(): int
    {
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isMassDelete = $isChild ? $this->option('is-mass-delete') : confirm('Do you need mass deleting?');

        $namespace = "App\Http\Controllers\\$this->domain\Admin";
        $model = str($name)->ucfirst();
        $kebabModel = str($name)->kebab();
        $snakeModel = str($name)->snake();
        $camelModel = str($name)->camel();
        $kebabPluralModel = str($name)->pluralStudly()->snake();
        $domain = str($this->domain)->ucfirst();
        $kebabDomain = str($this->domain)->kebab();
        $snakeDomain = str($this->domain)->snake();
        $camelDomain = str($this->domain)->camel();

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $model,
            "{{ kebabModel }}" => $kebabModel,
            "{{ snakeModel }}" => $snakeModel,
            "{{ camelModel }}" => $camelModel,
            "{{ domain }}" => $domain,
            "{{ kebabDomain }}" => $kebabDomain,
            "{{ snakeDomain }}" => $snakeDomain,
            "{{ camelDomain }}" => $camelDomain,
            "{{ kebabPluralModel }}" => $kebabPluralModel
        ];

        $this->outputFilePath = base_path("app/Http/Controllers/$this->domain/Admin/{$name}Controller.php");
        if($isMassDelete) {
            $this->setStubContent('base-admin-controller.mass-delete');
        } else {
            $this->setStubContent('base-admin-controller');
        }

        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
