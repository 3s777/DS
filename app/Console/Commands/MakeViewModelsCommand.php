<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeViewModelsCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:vmodel {name}
    {--is-child}
    {--domain}
    {--is-filters}
    {--is-user}';

    protected $description = 'New View Models';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $this->model = $this->argument('name');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use filters?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $namespace = "Domain\\$this->domain\ViewModels\Admin";
        $query = $this->prepareQuery($modelNames['databaseModel'], $isUser, $isFilters);

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ domain }}" => $this->domain,
            "{{ camelPluralModel }}" => $modelNames['camelPluralModel'],
            "{{ query }}" => $query
        ];

        if(!File::exists(base_path("src/Domain/$this->domain/ViewModels"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/ViewModels"));
            File::makeDirectory(base_path("src/Domain/$this->domain/ViewModels/Admin/"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/ViewModels/Admin/{$this->model}IndexViewModel.php");
        $this->setStubContent('base-admin-index-viewmodel');
        $this->createFromStub($replace);
        $this->createFile();

        $selectedUser = $isUser ? "public function selectedUser(): array
    {
        return \$this->getSelectedUser(\$this->{$modelNames['camelModel']});
    }" : "";
        $importUserTrait = $isUser ? "use Support\Traits\HasSelectedUser;" : "";
        $userTrait = $isUser ? "use HasSelectedUser;" : "";

        $updateReplace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ domain }}" => $this->domain,
            "{{ camelModel }}" => $modelNames['camelModel'],
            "{{ selectedUser }}" => $selectedUser,
            "{{ importUserTrait }}" => $importUserTrait,
            "{{ userTrait }}" => $userTrait,
        ];

        $this->outputFilePath = base_path("src/Domain/$this->domain/ViewModels/Admin/{$this->model}UpdateViewModel.php");
        $this->setStubContent('base-admin-update-viewmodel');
        $this->createFromStub($updateReplace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function prepareQuery(string $databaseModel, bool $isUser, bool $isFilters): string
    {
        $query = "return $this->model::query()
            ->select('$databaseModel.id', '$databaseModel.name', '$databaseModel.slug', '$databaseModel.created_at',";
        if($isUser)
        {
            $query .= " 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', '$databaseModel.user_id')";
        } else {
            $query .= ")";
        }

        if($isFilters)
        {
            $query .= "
            ->filteredAdmin()
            ->sorted()";
        } else {
            $query .= "
            ->orderBy('id', 'DESC')";
        }

        $query .= "
            ->paginate(10)
            ->withQueryString();";

        return $query;
    }
}
