<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeRequestCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:request {name}
    {--is-child}
    {--with-update}
    {--domain}
    {--is-slug}
    {--is-featured-image}
    {--is-images}
    {--is-description}
    {--is-user}
    {--is-filters}
    ';

    protected $description = 'New Request';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $this->model = $this->argument('name');
        $isChild = $this->option('is-child');
        $withUpdate = $isChild ? true : $this->option('with-update');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use filters?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $replace = $this->prepareReplace(
            $isSlug,
            $isDescription,
            $isUser,
            $isFeaturedImage,
            $isImages
        );

        $this->outputFilePath = base_path("app/Http/Requests/$this->domain/Admin/Create{$this->model}Request.php");
        $this->setStubContent('base-admin-request');
        $this->createFromStub($replace);
        $this->createFile();

        if($withUpdate) {
            $updateReplace = $this->makeUpdateReplace($modelNames, $replace, $isFeaturedImage, $isImages, $isSlug);

            $this->outputFilePath = base_path("app/Http/Requests/$this->domain/Admin/Update{$this->model}Request.php");
            $this->setStubContent('base-admin-request');
            $this->createFromStub($updateReplace);
            $this->createFile();
        }

        if($isFilters) {
            $this->outputFilePath = base_path("app/Http/Requests/$this->domain/Admin/Filter{$this->model}Request.php");
            $this->setStubContent('base-admin-request.filters');
            $this->createFromStub($replace);
            $this->createFile();
        }

        return self::SUCCESS;
    }

    private function prepareReplace(
        bool $isSlug,
        bool $isDescription,
        bool $isUser,
        bool $isFeaturedImage,
        bool $isImages
    ): array
    {
        $requestName = "Create{$this->model}Request";
        $namespace = "App\Http\Requests\\$this->domain\Admin";
        $importModel = "use Domain\\$this->domain\Models\\$this->model;";
        $kebabPluralModel = str($this->model)->pluralStudly()->kebab();
        $slug = $isSlug ? "'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique($this->model::class)
            ]," : "";
        $slugAttribute = $isSlug ? "'slug' => __('common.slug')," : "";
        $description = $isDescription ? "'description' => ['nullable','string']," : "";
        $descriptionAttribute = $isDescription ? "'description' => __('common.description')," : "";
        $user = $isUser ? "'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ]," : "";
        $userAttribute = $isUser ? "'user_id' => trans_choice('user.users', 1)," : "";
        $featuredImage = $isFeaturedImage ? "'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ]," : "";
        $featuredImageAttribute = $isFeaturedImage ? "'featured_image' => __('common.featured_image')," : "";
        $images = $isImages ? "'images' => [
                'nullable',
                'max: 9'
            ],
            'images.*' => [
                'nullable',
                'mimes:jpg,png,jpeg',
                'max:10024'
            ]," : "";
        $imagesAttribute = $isImages ? "'images' => trans_choice('common.additional_image', 2)," : "";

        return [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ requestName }}" => $requestName,
            "{{ importModel }}" => $importModel,
            "{{ slug }}" => $slug,
            "{{ slugAttribute }}" => $slugAttribute,
            "{{ description }}" => $description,
            "{{ descriptionAttribute }}" => $descriptionAttribute,
            "{{ user }}" => $user,
            "{{ userAttribute }}" => $userAttribute,
            "{{ featuredImage }}" => $featuredImage,
            "{{ featuredImageAttribute }}" => $featuredImageAttribute,
            "{{ images }}" => $images,
            "{{ imagesAttribute }}" => $imagesAttribute,
            "{{ kebabPluralModel }}" => $kebabPluralModel
        ];
    }

    private function makeUpdateReplace(array $modelNames, array $replace, bool $isFeaturedImage, bool $isImages, bool $isSlug): array
    {

        $slug = $isSlug ? "'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique($this->model::class)->ignore(\$this->{$modelNames['snakeModel']})
            ]," : "";

        $requestName = "Update{$this->model}Request";
        $featuredImage = $isFeaturedImage ? "'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'featured_image_selected' => ['nullable', 'bool']," : "";

        $images = $isImages ? "'images' => [
                'nullable',
                'max: 9'
            ],
            'images.*' => [
                'nullable',
                'mimes:jpg,png,jpeg',
                'max:10024'
            ],
            'images_delete' => [
                'nullable'
            ]," : "";

        $replace['{{ slug }}'] = $slug;
        $replace['{{ requestName }}'] = $requestName;
        $replace['{{ featuredImage }}'] = $featuredImage;
        $replace['{{ images }}'] = $images;

        return $replace;
    }
}
