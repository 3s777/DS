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
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');

        $model = str($name)->ucfirst();
        $namespace = "Domain\\$this->domain\FilterRegistrars";
        $databaseModel = str($name)->pluralStudly()->snake();
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
            "{{ model }}" => $model,
            "{{ importUser }}" => $importUser,
            "{{ databaseModel }}" => $databaseModel,
            "{{ user }}" => $user
        ];

        if(!File::exists(base_path("src/Domain/$this->domain/FilterRegistrars"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/FilterRegistrars"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/FilterRegistrars/{$name}FilterRegistrar.php");
        $this->setStubContent('base-admin-filter-registrar');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }
}
