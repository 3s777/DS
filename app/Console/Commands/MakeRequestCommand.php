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
    ';

    protected $description = 'New Request';

    public function handle(): int
    {
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isChild = $this->option('is-child');
        $withUpdate = $isChild ? true : $this->option('with-update');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');

        $replace = $this->prepareReplace(
            $name,
            $isSlug,
            $isDescription,
            $isUser,
            $isFeaturedImage,
            $isImages
        );

        $this->outputFilePath = base_path("app/Http/Requests/$this->domain/Admin/Create{$name}Request.php");
        $this->setStubContent('base-admin-request');
        $this->createFromStub($replace);
        $this->createFile();

        if($withUpdate) {
            $updateReplace = $this->makeUpdateReplace($name, $replace, $isFeaturedImage, $isImages, $isSlug);

            $this->outputFilePath = base_path("app/Http/Requests/$this->domain/Admin/Update{$name}Request.php");
            $this->setStubContent('base-admin-request');
            $this->createFromStub($updateReplace);
            $this->createFile();
        }

        return self::SUCCESS;
    }

    private function prepareReplace(
        string $name,
        bool $isSlug,
        bool $isDescription,
        bool $isUser,
        bool $isFeaturedImage,
        bool $isImages
    ): array
    {
        $model = str($name)->ucfirst();
        $requestName = "Create{$name}Request";
        $namespace = "App\Http\Requests\\$this->domain\Admin";
        $importModel = "use Domain\\$this->domain\Models\\$name;";
        $slug = $isSlug ? "'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique($model::class)
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
            "{{ model }}" => $model,
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
            "{{ imagesAttribute }}" => $imagesAttribute
        ];
    }

    private function makeUpdateReplace(string $name, array $replace, bool $isFeaturedImage, bool $isImages, bool $isSlug): array
    {
        $snakeModel = str($name)->snake();
        $slug = $isSlug ? "'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique($name::class)->ignore(\$this->{$snakeModel})
            ]," : "";

        $requestName = "Update{$name}Request";
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
