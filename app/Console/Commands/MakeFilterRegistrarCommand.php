<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeFilterRegistrarCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:filter-registrar {name}
    {--is-child}
    {--domain}
    {--is-user}
    ';

    protected $description = 'New Filter Registrar';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $this->model = $this->argument('name');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $modelNames = $this->setModelNames();
        $this->setDomainNames();

        $namespace = "Domain\\$this->domain\FilterRegistrars";
        $databaseModel = $modelNames['databaseModel'];
        $importUser = $isUser ? "use Domain\Auth\Models\User;
use App\Filters\RelationFilter;" : "";
        $user = $isUser ? "'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                '$databaseModel',
                User::class,
                'user_id',
                trans_choice('user.choose', 1),
            )," : "";

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ importUser }}" => $importUser,
            "{{ databaseModel }}" => $modelNames['databaseModel'],
            "{{ user }}" => $user
        ];

        if(!File::exists(base_path("src/Domain/$this->domain/FilterRegistrars"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/FilterRegistrars"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/FilterRegistrars/{$this->model}FilterRegistrar.php");
        $this->setStubContent('base-admin-filter-registrar');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
