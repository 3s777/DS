<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeServiceCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:service {name}
    {--is-child}
    {--domain}
    {--is-slug}
    {--is-featured-image}
    {--is-images}
    {--is-description}
    {--is-user}
    ';

    protected $description = 'New Service';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $this->model = $this->argument('name');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $namespace = "Domain\\$this->domain\Services\Admin";
        $fields = $this->makeFields($modelNames['camelModel'], $isSlug, $isDescription, $isUser);
        $updateFields = $this->makeFields($modelNames['camelModel'], $isSlug, $isDescription, $isUser, true);
        $replaceImages = $this->prepareImages($modelNames['camelModel'], $isFeaturedImage, $isImages);

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ camelModel }}" => $modelNames['camelModel'],
            "{{ domain }}" => $this->domain,
            "{{ fields }}" => $fields,
            "{{ updateFields }}" => $updateFields,
        ];

        $replace = array_merge($replace, $replaceImages);

        if (!File::exists(base_path("src/Domain/$this->domain/Services"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/Services"));
            File::makeDirectory(base_path("src/Domain/$this->domain/Services/Admin/"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/Services/Admin/{$this->model}Service.php");
        $this->setStubContent('base-admin-service');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function makeFields(
        string $camelModel,
        bool $isSlug,
        bool $isDescription,
        bool $isUser,
        bool $isUpdate = false
    ): string {
        $fields = "'name' => \$data->name,";

        if ($isSlug) {
            $fields .= "
                    'slug' => \$data->slug,";
        }

        if ($isDescription) {
            $fields .= "
                    'description' => \$data->description,";
        }

        if ($isUser) {
            if ($isUpdate) {
                $fields .= "
                    'user_id' => \$data->user_id ?? \${$camelModel}->user_id,";
            } else {
                $fields .= "
                    'user_id' => \$data->user_id,";
            }
        }

        return $fields;
    }

    private function prepareImages(string $camelModel, $isFeaturedImage, $isImages): array
    {
        $addFeaturedImage = $isFeaturedImage ? "\${$camelModel}->addFeaturedImageWithThumbnail(
                \$data->featured_image,
                ['small', 'medium']
            );" : "";

        $updateFeaturedImage = $isFeaturedImage ? "\${$camelModel}->updateFeaturedImage(
                    \$data->featured_image,
                    \$data->featured_image_uploaded,
                    ['small', 'medium']
                );" : "";

        $addImages = $isImages ? "if (\$data->images) {
                foreach (\$data->images as \$key => \$image) {
                    \${$camelModel}->addImagesWithThumbnail(
                        \$image,
                        ['small', 'medium'],
                    );
                }
            }" : "";

        $updateImages = $isImages ? "\${$camelModel}->updateImages(
                    \$data->images,
                    \$data->images_delete,
                    ['small', 'medium']
                );" : "";

        return [
            '{{ addFeaturedImage }}' => $addFeaturedImage,
            '{{ updateFeaturedImage }}' => $updateFeaturedImage,
            '{{ addImages }}' => $addImages,
            '{{ updateImages }}' => $updateImages
        ];
    }
}
