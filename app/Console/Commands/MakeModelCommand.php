<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
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
        $isImages = confirm('Is Images?');
        $isDescription = confirm('Is Description?');
        $isUser = confirm('Is User?');
        $isSoftDelete = confirm('Is SoftDelete?');
        $isTranslatable = confirm('Translatable?');
        $domain = text('What Domain?');

        $name = str($this->argument('name'))->ucfirst();

        $stubModelContent = file_get_contents(base_path('stubs/base-model.stub'));

        $modelNamespace = "Domain\\$domain\Models";


        $importSoftDeleteTrait = $isSoftDelete ? "use Illuminate\Database\Eloquent\SoftDeletes;" : "";
        $softDeleteTrait = $isSoftDelete ? "use SoftDeletes;" : "";
        $importSlugTrait = $isSlug ? "use Support\Traits\Models\HasSlug;" : "";
        $slugTrait = $isSlug ? "use HasSlug;" : "";
        $importTranslatableTrait = $isTranslatable ? "use Spatie\Translatable\HasTranslations;" : "";
        $translatableTrait = $isTranslatable ? "use HasTranslations;" : "";
        $translatable = $isTranslatable ? "public \$translatable = ['name', 'description'];" : "";
        $importFactoryTrait = $isFactory ? "use Illuminate\Database\Eloquent\Factories\HasFactory;" : "";
        $factoryTrait = $isFactory ? "use HasFactory;" : "";
        $factoryImport = $isFactory ? "use Database\Factories\\$domain\\{$domain}Factory;" : "";
        $factoryDefinition = $isFactory ? "protected static function newFactory(): PageFactory
    {
        return {$domain}Factory::new();
    }" : "";

        $importCleanHtmlCast = $isDescription ? "use Mews\Purifier\Casts\CleanHtml;" : "";

        $importUserModel = $isUser ? "use Domain\Auth\Models\User;" : "";
        $importHasUserTrait = $isUser ? "use Support\Traits\Models\HasUser;" : "";
        $importBelongTo = $isUser ? "use Illuminate\Database\Eloquent\Relations\BelongsTo;" : "";
        $hasUserTrait = $isUser ? "use HasUser;" : "";
        $userRelation = $isUser ? "public function user(): BelongsTo
    {
        return \$this->belongsTo(User::class);
    }" : "";


        $fillable = $this->makeFillable($isSlug, $isDescription, $isFeaturedImage, $isImages);
        $imageData = $this->makeImages($isFeaturedImage, $isImages);
        $class = $this->makeClass($name, $isFeaturedImage);
        $casts = $this->makeCasts($isDescription, $isImages);

        $stubModelContent = str_replace(
            [
                "{{ namespace }}",
                "{{ class }}",
                "{{ importFactoryTrait }}",
                "{{ factoryTrait }}",
                "{{ factoryImport }}",
                "{{ factoryDefinition }}",
                "{{ importSoftDeleteTrait }}",
                "{{ softDeleteTrait }}",
                "{{ importSlugTrait }}",
                "{{ slugTrait }}",
                "{{ importTranslatableTrait }}",
                "{{ translatableTrait }}",
                "{{ translatable }}",
                "{{ importHasMediaTrait }}",
                "{{ importFeaturedImageTrait }}",
                "{{ importImageTrait }}",
                "{{ importImagesTrait }}",
                "{{ importInteractsWithMediaTrait }}",
                "{{ featuredImageTrait }}",
                "{{ imageTrait }}",
                "{{ imagesTrait }}",
                "{{ imageProperties }}",
                "{{ interactsWithMediaTrait }}",
                "{{ importCleanHtmlCast }}",
                "{{ importBelongTo }}",
                "{{ importUserModel }}",
                "{{ importHasUserTrait }}",
                "{{ hasUserTrait }}",
                "{{ userRelation }}",
                "{{ casts }}",
                "{{ fillable }}"
            ],
            [
                $modelNamespace,
                $class,
                $importFactoryTrait,
                $factoryTrait,
                $factoryImport,
                $factoryDefinition,
                $importSoftDeleteTrait,
                $softDeleteTrait,
                $importSlugTrait,
                $slugTrait,
                $importTranslatableTrait,
                $translatableTrait,
                $translatable,
                $imageData['importHasMediaTrait'],
                $imageData['importFeaturedImageTrait'],
                $imageData['importImageTrait'],
                $imageData['importImagesTrait'],
                $imageData['importInteractsWithMediaTrait'],
                $imageData['featuredImageTrait'],
                $imageData['imageTrait'],
                $imageData['imagesTrait'],
                $imageData['imageProperties'],
                $imageData['interactsWithMediaTrait'],
                $importCleanHtmlCast,
                $importBelongTo,
                $importUserModel,
                $importHasUserTrait,
                $hasUserTrait,
                $userRelation,
                $casts,
                $fillable
            ],
            $stubModelContent
        );


        if($isMigration) {
            $this->makeMigration(
                $this->argument('name'),
                $jsonName,
                $isSlug,
                $isFeaturedImage,
                $isUser,
                $isDescription,
                $isSoftDelete
            );
        }

        if($isFactory) {
            $this->makeFactory(
                $name,
                $domain,
                $namespacedModel,
                $isUser = false,
                $isDescription = false,
                $isTranslatable  = false
            );
        }


        file_put_contents(
            base_path("src/Domain/$domain/Models/$name.php"),
            $stubModelContent
        );

        return self::SUCCESS;
    }

    private function makeClass(
        string $name,
        bool $isFeaturedImage = false
    ): string
    {
        $class = "class $name extends Model";

        if($isFeaturedImage) {
            $class .= " implements HasMedia";
        }

        return $class;
    }

    private function makeCasts(bool $isDescription = false, bool $isImages = false): string
    {
        $casts = "protected \$casts = [";

        if($isDescription) {
            $casts .= "
        'description' => CleanHtml::class.':custom',";
        }

        if($isImages) {
            $casts .= "
        'images' => 'array',";
        }

        $casts .= "
    ];";

        return $casts;
    }

    private function makeImages(bool $isFeaturedImage = false, $isImages = false): array
    {
        $importFeaturedImageTrait = $isFeaturedImage ? "use Support\Traits\Models\HasFeaturedImage;" : "";
        $importImageTrait = $isFeaturedImage ? "use Support\Traits\Models\HasImage;" : "";
        $importImagesTrait = $isImages ? "use Support\Traits\Models\HasImages;" : "";
        $importHasMediaTrait = $isFeaturedImage ? "use Spatie\MediaLibrary\HasMedia;" : "";
        $importInteractsWithMediaTrait = $isFeaturedImage ? "use Spatie\MediaLibrary\InteractsWithMedia;" : "";
        $featuredImageTrait = $isFeaturedImage ? "use HasFeaturedImage;" : "";
        $imageTrait = $isFeaturedImage ? "use HasImage;" : "";
        $imagesTrait = $isImages ? "use HasImages;" : "";
        $interactsWithMediaTrait = $isFeaturedImage ? "use InteractsWithMedia;" : "";
        $imageFolderName = str($this->argument('name'))->snake();
        $imageProperties = $isFeaturedImage ? "public function imagesDir(): string
    {
        return '$imageFolderName';
    }

    public function thumbnailSizes(): array
    {
        return [
            'small' => ['220', '220'],
            'medium' => ['500', '500'],
            'full_preview' => ['550', '550'],
            'full_preview_300' => ['300', '300'],
            'full_preview_400' => ['400', '400'],
            'full_preview_600' => ['600', '600'],
            'full_preview_1200' => ['1200', '1200'],
            'large' => ['1000', '1000'],
        ];
    }" : "";

        $imageData = [
            'importFeaturedImageTrait' => $importFeaturedImageTrait,
            'importImageTrait' => $importImageTrait,
            'importImagesTrait' => $importImagesTrait,
            'importHasMediaTrait' => $importHasMediaTrait,
            'importInteractsWithMediaTrait' => $importInteractsWithMediaTrait,
            'featuredImageTrait' => $featuredImageTrait,
            'imageTrait' => $imageTrait,
            'imagesTrait' => $imagesTrait,
            'interactsWithMediaTrait' => $interactsWithMediaTrait,
            'imageFolderName' => $imageFolderName,
            'imageProperties' => $imageProperties
        ];

        return $imageData;
    }

    private function makeFillable(
        bool $isSlug = false,
        bool $isDescription = false,
        bool $isFeaturedImage = false,
        bool $isImages = false,
    ): string
    {
        $fillable = "protected \$fillable = [
        'name',";

        if($isSlug) {
            $fillable.= "
        'slug',";
        }

        if($isDescription) {
            $fillable.= "
        'description',";
        }

        if($isFeaturedImage) {
            $fillable.= "
        'featured_image',";
        }

        if($isImages) {
            $fillable.= "
        'images',";
        }

        $fillable = "$fillable
    ];";

        return $fillable;
    }

    private function makeMigration(
        string $name,
        bool $jsonName = false,
        bool $isSlug = false,
        bool $isFeaturedImage = false,
        bool $isUser = false,
        bool $isDescription = false,
        bool $isSoftDelete  = false
    )
    {
        $migrationName = str($name)
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
        $fieldSoftDelete = $isSoftDelete ? '$table->softDeletes();' : '';

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

    private function makeFactory(
        string $name,
        string $domain,
        string $namespacedModel,
        bool $isUser = false,
        bool $isDescription = false,
        bool $isTranslatable  = false
    )
    {

        $factoryFileName = "{$name}Factory.php";

        $stubFactoryContent = file_get_contents(base_path('stubs/base-factory.stub'));

        $factory = "{$name}Factory";
        $factoryNamespace = "Database\Factories\{$name}";
        $factoryModel = "protected \$model = $name::class;";
        $definition = "public function definition(): array
    {
        return [
            //
        ];
    }";

        $stubFactoryContent = str_replace(
            [
                "{{ factoryNamespace }}",
                "{{ namespacedModel }}",
                "{{ factory }}",
                "{{ factoryModel }}",
                "{{ definition }}",
            ],
            [
                $factoryNamespace,
                $namespacedModel,
                $factory,
                $factoryModel,
                $definition,
            ],
            $stubFactoryContent
        );

        file_put_contents(
            database_path("factories/$domain/$factoryFileName"),
            $stubFactoryContent
        );
    }
}
