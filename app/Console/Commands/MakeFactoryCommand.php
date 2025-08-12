<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use function Laravel\Prompts\{confirm, text};

class MakeFactoryCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:factory {name}
    {--is-child}
    {--domain}
    {--json-name}
    {--is-description}
    {--is-user}
    {--is-translatable}';

    protected $description = 'New Factory with base fields';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->model = $this->argument('name');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $jsonName = $isChild ? $this->option('json-name') : confirm('Is name must be json?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $isTranslatable = $isChild ? $this->option('is-translatable') : confirm('Translatable?');
        $this->setModelNames();
        $this->setDomainNames();

        $replace = $this->prepareReplace(
            $jsonName,
            $isDescription,
            $isUser,
            $isTranslatable
        );

        $this->outputFilePath = database_path("factories/{$this->domain}/{$this->model}Factory.php");
        $this->setStubContent('base-factory');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function prepareReplace(
        bool $jsonName,
        bool $isDescription,
        bool $isUser,
        bool $isTranslatable
    ): array {
        $factoryNamespace = "Database\Factories\\$this->domain";
        $factoryModel = "protected \$model = $this->model::class;";
        $namespacedModel = "Domain\\$this->domain\Models\\$this->model";
        $userModel = $isUser ? "use Domain\Auth\Models\User;" : "";

        $definition = $this->makeDefinition(
            $jsonName,
            $isDescription,
            $isUser,
            $isTranslatable
        );

        return [
            "{{ factoryNamespace }}" => $factoryNamespace,
            "{{ namespacedModel }}" => $namespacedModel,
            "{{ factory }}" => $this->model,
            "{{ factoryModel }}" => $factoryModel,
            "{{ definition }}" => $definition,
            "{{ userModel }}" => $userModel
        ];
    }

    private function makeDefinition(
        bool $jsonName = false,
        bool $isDescription = false,
        bool $isUser = false,
        bool $isTranslatable = false,
    ): string {
        $definition = "public function definition(): array
    {
        return [";

        if ($jsonName) {
            $definition .= "
            'name' => \$this->translations(['en', 'ru'], [fake()->name(), fake()->name()]),";
        } else {
            $definition .= "
            'name' => fake()->name(),";
        }

        if ($isDescription && $isTranslatable) {
            $definition .= "
            'description' => \$this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),";
        }

        if ($isDescription && !$isTranslatable) {
            $definition .= "
            'description' => fake()->text(200),";
        }

        if ($isUser) {
            $definition .= "
            'user_id' => User::factory(),";
        }

        $definition = "$definition
        ];
    }";

        return $definition;
    }
}
