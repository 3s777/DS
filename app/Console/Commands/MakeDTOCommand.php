<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeDTOCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:dto {name}
    {--is-child}
    {--domain}
    {--is-slug}
    {--is-featured-image}
    {--is-images}
    {--is-description}
    {--is-user}
    ';

    protected $description = 'New DTO';

    public function handle(): int
    {
        $isChild = $this->option('is-child');
        $this->model = $this->argument('name');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $modelNames = $this->setModelNames();
        $domainNames = $this->setDomainNames();

        $namespace = "Domain\\$this->domain\DTOs";
        $attributes = $this->makeAttributes($isSlug, $isDescription, $isUser, $isFeaturedImage, $isImages);
        $attributesNames = $this->makeAttributesNames($isSlug, $isDescription, $isUser, $isFeaturedImage, $isImages);

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $this->model,
            "{{ attributes }}" => $attributes,
            "{{ attributesNames }}" => $attributesNames
        ];

        if(!File::exists(base_path("src/Domain/$this->domain/DTOs"))) {
            File::makeDirectory(base_path("src/Domain/$this->domain/DTOs"));
        }

        $this->outputFilePath = base_path("src/Domain/$this->domain/DTOs/Fill{$this->model}DTO.php");
        $this->setStubContent('base-admin-dto');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function makeAttributes(
        bool $isSlug,
        bool $isDescription,
        bool $isUser,
        bool $isFeaturedImage,
        bool $isImages
    ): string
    {
        $attributes = "public string \$name,";

        if($isSlug) {
            $attributes .=  "
        public ?string \$slug = null,";
        }

        if($isDescription) {
            $attributes .=  "
        public ?string \$description = null,";
        }

        if($isUser) {
            $attributes .=  "
        public ?int \$user_id = null,";
        }

        if($isFeaturedImage) {
            $attributes .=  "
        public ?UploadedFile \$featured_image = null,
        public ?bool \$featured_image_uploaded = null,";
        }

        if($isImages) {
            $attributes .=  "
        public ?array \$images = null,
        public ?string \$images_delete = null,";
        }

        return $attributes;
    }

    private function makeAttributesNames(
        bool $isSlug,
        bool $isDescription,
        bool $isUser,
        bool $isFeaturedImage,
        bool $isImages
    ): string
    {
        $attributesNames = "'name',";

        if($isSlug) {
            $attributesNames .= "
            'slug',";
        }

        if($isDescription) {
            $attributesNames .= "
            'description',";
        }

        if($isUser) {
            $attributesNames .= "
            'user_id',";
        }

        if($isFeaturedImage) {
            $attributesNames .= "
            'featured_image',
            'featured_image_uploaded',";
        }

        if($isImages) {
            $attributesNames .= "
            'images',
            'images_delete',";
        }

        return $attributesNames;
    }
}
