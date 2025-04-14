<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\confirm;

class MakeMigrationCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:migration {name}
    {--is-child}
    {--json-name}
    {--is-slug}
    {--is-featured-image}
    {--is-images}
    {--is-description}
    {--is-user}
    {--is-soft-delete}
    {--is-translatable}';

    protected $description = 'New Migration with base fields';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $jsonName = $isChild ? $this->option('json-name') : confirm('Is name must be json?');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $isSoftDelete = $isChild ? $this->option('is-soft-delete') : confirm('Is SoftDelete?');
        $isTranslatable = $isChild ? $this->option('is-translatable') : confirm('Translatable?');

        $migrationName = str($this->argument('name'))
            ->pluralStudly()
            ->snake();

        $migrationFileName = date('Y_m_d_His').'_create_'.$migrationName.'_table.php';

        $replace = $this->prepareReplace(
            $migrationName,
            $jsonName,
            $isSlug,
            $isFeaturedImage,
            $isDescription,
            $isUser,
            $isSoftDelete,
            $isImages, $isTranslatable
        );

        $this->outputFilePath = database_path("migrations/$migrationFileName");
        $this->setStubContent('base-migration.create');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function prepareReplace(
        string $migrationName,
        bool $jsonName,
        bool $isSlug,
        bool $isFeaturedImage,
        bool $isDescription,
        bool $isUser,
        bool $isSoftDelete,
        bool $isImages,
        bool $isTranslatable
    ): array
    {
        $fieldName = $jsonName ? '$table->jsonb(\'name\');' : '$table->string(\'name\');';
        $fieldSlug = $isSlug ? '$table->string(\'slug\')->unique();' : '';
        $fieldFeaturedImage = $isFeaturedImage ? '$table->string(\'featured_image\')->nullable();' : '';
        $fieldDescription = $isDescription ? '$table->string(\'description\')->nullable();' : '';
        $fieldUser = $isUser ? '$table->foreignIdFor(User::class)
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();' : '';
        $userModel = $isUser ? 'use Domain\Auth\Models\User;' : '';
        $fieldSoftDelete = $isSoftDelete ? '$table->softDeletes();' : '';
        $fieldImages = $isImages ? '$table->text(\'images\')->nullable();' : '';

        if($isTranslatable && $isDescription) {
            $fieldDescription = '$table->jsonb(\'description\')->nullable();';
        }

        return [
            '{{ table }}' => $migrationName,
            '{{ fieldName }}' => $fieldName,
            '{{ fieldSlug }}' => $fieldSlug,
            '{{ fieldFeaturedImage }}' => $fieldFeaturedImage,
            '{{ fieldDescription }}' => $fieldDescription,
            '{{ fieldUser }}' => $fieldUser,
            '{{ fieldSoftDelete }}' => $fieldSoftDelete,
            '{{ fieldImages }}' => $fieldImages,
            '{{ userModel }}' => $userModel
        ];
    }
}
