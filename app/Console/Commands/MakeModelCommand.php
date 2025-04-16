<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeModelCommand extends BaseCommand implements PromptsForMissingInput
{
//    protected $signature = 'ds:model {name} {--m|migration} {--f|factory}';
    protected $signature = 'ds:model {name}';

    protected $description = 'New Model with Migration and Factory';

    public function handle(): int
    {
        $name = str($this->argument('name'))->ucfirst();
        $this->domain = text('What Domain?');
        $isMigration = confirm('Create Migration?');
        $isFactory = confirm('Create Factory?');
        $isController = confirm('Create Controller?');
        $isRequest = confirm('Create Request?');
        $isDTO = confirm('Create DTO?');
        $isViewModels = confirm('Create VeiwModels?');
        $isService = confirm('Create Service?');
        $isViews = confirm('Create Views?');
        $jsonName = confirm('Is name must be json?');
        $isSlug = confirm('Is slug?');
        $isFeaturedImage = confirm('Is Featured Image?');
        $isImages = confirm('Is Images?');
        $isDescription = confirm('Is Description?');
        $isUser = confirm('Is User?');
        $isSoftDelete = confirm('Is SoftDelete?');
        $isTranslatable = confirm('Translatable?');
        $isMassDelete = confirm('Do you need mass deleting?');
        $isFilters = confirm('Use filters?');

        $modelNamespace = "Domain\\$this->domain\Models";
        $importCleanHtmlCast = $isDescription ? "use Mews\Purifier\Casts\CleanHtml;" : "";
        $fillable = $this->makeFillable($isSlug, $isDescription, $isFeaturedImage, $isImages, $isUser);
        $class = $this->makeClass($name, $isFeaturedImage);
        $casts = $this->makeCasts($isDescription, $isImages);

        $replace = [
            "{{ namespace }}" => $modelNamespace,
            "{{ class }}" => $class,
            "{{ casts }}" => $casts,
            "{{ fillable }}" => $fillable,
            "{{ importCleanHtmlCast }}" => $importCleanHtmlCast,
        ];

        $imageData = $this->makeImages($isFeaturedImage, $isImages);
        $importFactory = $this->makeImportFactory($isFactory);
        $slug = $this->makeSlug($isSlug);
        $user = $this->makeUser($isUser);
        $translatable = $this->makeTranslatable($isTranslatable);
        $softDelete = $this->makeSofDelete($isSoftDelete);
        $filters = $this->prepareFilters($name, $this->domain);

        $resultReplace = array_merge(
            $replace,
            $imageData,
            $importFactory,
            $slug,
            $user,
            $translatable,
            $softDelete,
            $filters
        );

        $this->outputFilePath = base_path("src/Domain/$this->domain/Models/$name.php");
        $this->setStubContent('base-model');
        $this->createFromStub($resultReplace);
        $this->createFile();

        if($isMigration) {
            $this->call('ds:migration', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--json-name' => $jsonName,
                '--is-slug' => $isSlug,
                '--is-featured-image' => $isFeaturedImage,
                '--is-images' => $isImages,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
                '--is-soft-delete' => $isSoftDelete,
                '--is-translatable' => $isTranslatable,
            ]);
        }

        if($isFactory) {
            $this->call('ds:factory', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--json-name' => $jsonName,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
                '--is-translatable' => $isTranslatable,
            ]);
        }

        if($isController) {
            $this->call('ds:controller', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-mass-delete' => $isMassDelete
            ]);
        }

        if($isRequest) {
            $this->call('ds:request', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--with-update' => true,
                '--domain' => $this->domain,
                '--is-slug' => $isSlug,
                '--is-featured-image' => $isFeaturedImage,
                '--is-images' => $isImages,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
            ]);
        }

        if($isDTO) {
            $this->call('ds:dto', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-slug' => $isSlug,
                '--is-featured-image' => $isFeaturedImage,
                '--is-images' => $isImages,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
            ]);
        }

        if($isViewModels) {
            $this->call('ds:vmodel', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-filters' => $isFilters,
                '--is-user' => $isUser,
            ]);
        }

        if($isService) {
            $this->call('ds:service', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-slug' => $isSlug,
                '--is-featured-image' => $isFeaturedImage,
                '--is-images' => $isImages,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
            ]);
        }

        if($isViews) {
            $this->call('ds:views', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-slug' => $isSlug,
                '--is-featured-image' => $isFeaturedImage,
                '--is-images' => $isImages,
                '--is-description' => $isDescription,
                '--is-user' => $isUser,
                '--is-mass-delete' => $isMassDelete,
                '--is-filters' => $isFilters
            ]);
        }

        if($isFilters) {
            $this->call('ds:filter-registrar', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
                '--is-user' => $isUser,
            ]);

            $this->call('ds:builder', [
                'name' => $this->argument('name'),
                '--is-child' => true,
                '--domain' => $this->domain,
            ]);
        }

        return self::SUCCESS;
    }

    private function makeSofDelete(bool $isSoftDelete = false): array
    {
        $importSoftDeleteTrait = $isSoftDelete ? "use Illuminate\Database\Eloquent\SoftDeletes;" : "";
        $softDeleteTrait = $isSoftDelete ? "use SoftDeletes;" : "";

        return [
            '{{ importSoftDeleteTrait }}' => $importSoftDeleteTrait,
            '{{ softDeleteTrait }}' => $softDeleteTrait,
        ];
    }

    private function makeTranslatable(bool $isTranslatable = false): array
    {
        $importTranslatableTrait = $isTranslatable ? "use Spatie\Translatable\HasTranslations;" : "";
        $translatableTrait = $isTranslatable ? "use HasTranslations;" : "";
        $translatable = $isTranslatable ? "public \$translatable = ['name', 'description'];" : "";

        return [
            '{{ importTranslatableTrait }}' => $importTranslatableTrait,
            '{{ translatableTrait }}' => $translatableTrait,
            '{{ translatable }}' => $translatable,
        ];
    }

    private function makeUser(bool $isUser = false): array
    {
        $importUserModel = $isUser ? "use Domain\Auth\Models\User;" : "";
        $importHasUserTrait = $isUser ? "use Support\Traits\Models\HasUser;" : "";
        $importBelongTo = $isUser ? "use Illuminate\Database\Eloquent\Relations\BelongsTo;" : "";
        $hasUserTrait = $isUser ? "use HasUser;" : "";
        $userRelation = $isUser ? "public function user(): BelongsTo
    {
        return \$this->belongsTo(User::class);
    }" : "";

        return [
            '{{ importUserModel }}' => $importUserModel,
            '{{ importHasUserTrait }}' => $importHasUserTrait,
            '{{ importBelongTo }}' => $importBelongTo,
            '{{ hasUserTrait }}' => $hasUserTrait,
            '{{ userRelation }}' => $userRelation
        ];
    }

    private function makeSlug(bool $isSlug = false):array
    {
        $importSlugTrait = $isSlug ? "use Support\Traits\Models\HasSlug;" : "";
        $slugTrait = $isSlug ? "use HasSlug;" : "";

        return [
            '{{ importSlugTrait }}' => $importSlugTrait,
            '{{ slugTrait }}' =>$slugTrait,
        ];
    }

    private function makeImportFactory(bool $isFactory = false):array
    {
        $importFactoryTrait = $isFactory ? "use Illuminate\Database\Eloquent\Factories\HasFactory;" : "";
        $factoryTrait = $isFactory ? "use HasFactory;" : "";
        $factoryImport = $isFactory ? "use Database\Factories\\$this->domain\\{$this->domain}Factory;" : "";
        $factoryDefinition = $isFactory ? "protected static function newFactory(): PageFactory
    {
        return {$this->domain}Factory::new();
    }" : "";

        return [
            '{{ importFactoryTrait }}' => $importFactoryTrait,
            '{{ factoryTrait }}' => $factoryTrait,
            '{{ factoryImport }}' => $factoryImport,
            '{{ factoryDefinition }}' => $factoryDefinition
        ];
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

        return [
            '{{ importFeaturedImageTrait }}' => $importFeaturedImageTrait,
            '{{ importImageTrait }}' => $importImageTrait,
            '{{ importImagesTrait }}' => $importImagesTrait,
            '{{ importHasMediaTrait }}' => $importHasMediaTrait,
            '{{ importInteractsWithMediaTrait }}' => $importInteractsWithMediaTrait,
            '{{ featuredImageTrait }}' => $featuredImageTrait,
            '{{ imageTrait }}' => $imageTrait,
            '{{ imagesTrait }}' => $imagesTrait,
            '{{ interactsWithMediaTrait }}' => $interactsWithMediaTrait,
            '{{ imageFolderName }}' => $imageFolderName,
            '{{ imageProperties }}' => $imageProperties
        ];
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


    private function makeFillable(
        bool $isSlug = false,
        bool $isDescription = false,
        bool $isFeaturedImage = false,
        bool $isImages = false,
        bool $isUser = false
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

        if($isUser) {
            $fillable.= "
        'user_id',";
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

    private function prepareFilters(string $model, string $domain): array
    {
        $filters = "public array \$sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    public function availableAdminFilters(): array
    {
        return app({$model}FilterRegistrar::class)->filtersList();
    }

    public function availableFilters(): array
    {
        return [];
    }

    public function newEloquentBuilder(\$query): {$model}QueryBuilder
    {
        return new {$model}QueryBuilder(\$query);
    }";

        $importFilters = "use Domain\\$domain\FilterRegistrars\\{$model}FilterRegistrar;
use Domain\\$domain\QueryBuilders\\{$model}QueryBuilder;";

        return [
            '{{ filters }}' => $filters,
            '{{ importFilters }}' => $importFilters
        ];
    }
}
