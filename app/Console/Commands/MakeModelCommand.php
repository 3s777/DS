<?php

namespace App\Console\Commands;

use Database\Factories\Page\PageFactory;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeModelCommand extends Command implements PromptsForMissingInput
{
//    protected $signature = 'ds:model {name} {--m|migration} {--f|factory}';
    protected $signature = 'ds:model {name}';

    protected $description = 'New Model with Migration and Factory';

    public function handle(): int
    {
        $isMigration = confirm('Create Migration?');
        $isFactory = confirm('Create Factory?');
        $jsonName = confirm('Is name must be json?');
        $isSlug = confirm('Is slug?');
        $isFeaturedImage = confirm('Is Featured Image?');
        $isDescription = confirm('Is Description?');
        $isUser = confirm('Is User?');
        $isSofDelete = confirm('Is SoftDelete?');
        $domain = text('What Domain?');

        $name = str($this->argument('name'))->ucfirst();

        $stubModelContent = file_get_contents(base_path('stubs/base-model.stub'));
        $modelNamespace = "Domain\\$domain\Models";
        $class = "class $name extends Model";
        $importFactoryTrait = $isFactory ? "use Illuminate\Database\Eloquent\Factories\HasFactory;" : "";
        $factoryTrait = $isFactory ? "use HasFactory;" : "";
        $factoryImport = $isFactory ? "use Database\Factories\\$domain\\{$domain}Factory;" : "";
        $factoryDefinition = $isFactory ? "protected static function newFactory(): PageFactory
    {
        return {$domain}Factory::new();
    }" : "";



        $stubModelContent = str_replace(
            [
                "{{ namespace }}",
                "{{ class }}",
                "{{ importFactoryTrait }}",
                "{{ factoryTrait }}",
                "{{ factoryImport }}",
                "{{ factoryDefinition }}",
            ],
            [
                $modelNamespace,
                $class,
                $importFactoryTrait,
                $factoryTrait,
                $factoryImport,
                $factoryDefinition
            ],
            $stubModelContent
        );


        if($isMigration) {
            $migrationName = str($this->argument('name'))
                ->pluralStudly()
                ->snake();

            $migrationFileName = date('Y_m_d_His').'_create_'.$migrationName.'_table.php';

            $stubMigrationContent = file_get_contents(base_path('stubs/base-migration.create.stub'));

            $fieldName = $jsonName ? '$table->jsonb(\'name\');' : '$table->string(\'name\');';
            $fieldSlug = $isSlug ? '$table->string(\'slug\')->unique();' : '';
            $fieldFeaturedImage = $isFeaturedImage ? '$table->string(\'featured_image\')->nullable();' : '';
            $fieldDescription = $isDescription ? '$table->jsonb(\'description\')->nullable();' : '';
            $fieldUser = $isUser ? '$table->foreignIdFor(User::class)
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();' : '';
            $userModel = $isUser ? 'use Domain\Auth\Models\User;' : '';
            $fieldSoftDelete = $isSofDelete ? '$table->softDeletes();' : '';

            $stubMigrationContent = str_replace(
                [
                    "{{ table }}",
                    "{{ fieldName }}",
                    "{{ fieldSlug }}",
                    "{{ fieldFeaturedImage }}",
                    "{{ fieldDescription }}",
                    "{{ fieldUser }}",
                    "{{ userModel }}",
                    "{{ fieldSoftDelete }}"
                ],
                [
                    $migrationName,
                    $fieldName,
                    $fieldSlug,
                    $fieldFeaturedImage,
                    $fieldDescription,
                    $fieldUser,
                    $userModel,
                    $fieldSoftDelete
                ],
                $stubMigrationContent
            );

            file_put_contents(
                database_path("migrations/$migrationFileName"),
                $stubMigrationContent
            );
        }


        file_put_contents(
            base_path("src/Domain/$domain/Models/$name.php"),
            $stubModelContent
        );

        return self::SUCCESS;
    }
}
