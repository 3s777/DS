<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeViewsCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:views {name}
    {--is-child}
    {--domain}
    {--is-slug}
    {--is-featured-image}
    {--is-images}
    {--is-description}
    {--is-user}
    {--is-mass-delete}
    {--is-filters}
    ';

    protected $description = 'New Views';

    public function handle(): int
    {
        $name = $this->argument('name');
        $isChild = $this->option('is-child');
        $this->domain = $isChild ? $this->option('domain') : text('What domain is?');
        $isSlug = $isChild ? $this->option('is-slug') : confirm('Is slug?');
        $isFeaturedImage = $isChild ? $this->option('is-featured-image') : confirm('Is Featured Image?');
        $isImages = $isChild ? $this->option('is-images') : confirm('Is Images?');
        $isDescription = $isChild ? $this->option('is-description') : confirm('Is Description?');
        $isUser = $isChild ? $this->option('is-user') : confirm('Is User?');
        $isMassDelete = $isChild ? $this->option('is-mass-delete') : confirm('Do you need mass deleting?');
        $isFilters = $isChild ? $this->option('is-filters') : confirm('Use filters?');

        $model = str($name)->ucfirst();
        $namespace = "Domain\\$this->domain\DTOs";
        $kebabPluralModel = str($name)->pluralStudly()->kebab();
        $snakeModel = str($name)->snake();
        $camelModel = str($name)->camel();
        $camelPluralModel = str($name)->pluralStudly()->camel();
        $sidebar = $isFeaturedImage ? "<x-slot:sidebar></x-slot:sidebar>" : "";
        $images = $isFeaturedImage ? ":images=\"true\"" : "";
        $description = $isDescription ? "" : ":description=\"false\"";
        $kebabDomain = str($this->domain)->kebab();
        $kebabModel = str($model)->kebab();
        $fields = $this->makeFields($camelModel, $isSlug, $isUser);
        $massDelete = $isMassDelete ? '' : ':mass-delete="false" :selectable="false"';
        $langModel = str($name)->remove($this->domain)->snake();
        $checkboxHeader = $isMassDelete ? '<x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$'.$camelPluralModel.'" />
                </x-ui.responsive-table.column>' : '';
        $checkboxRow = $isMassDelete ? '<x-ui.responsive-table.column type="select">
                     <x-common.action-table.row-checkbox :model="$item" />
                </x-ui.responsive-table.column>' : '';
        $kebabModelWithoutDomain = str($name)->remove($this->domain)->kebab();

        $replace = [
            "{{ namespace }}" => $namespace,
            "{{ model }}" => $model,
            "{{ kebabPluralModel }}" => $kebabPluralModel,
            "{{ snakeModel }}" => $snakeModel,
            "{{ langModel }}" => $langModel,
            "{{ camelModel }}" => $camelModel,
            "{{ kebabDomain }}" => $kebabDomain,
            "{{ sidebar }}" => $sidebar,
            "{{ images }}" => $images,
            "{{ description }}" => $description,
            "{{ slug }}" => $fields['{{ slug }}'],
            "{{ user }}" => $fields['{{ user }}'],
            "{{ massDelete }}" => $massDelete,
            "{{ camelPluralModel }}" => $camelPluralModel,
            "{{ checkboxHeader }}" => $checkboxHeader,
            "{{ checkboxRow }}" => $checkboxRow,
            "{{ kebabModelWithoutDomain }}" => $kebabModelWithoutDomain,
        ];

        if(!File::exists(base_path("resources/views/admin/{$kebabDomain}/{$langModel}"))) {
            File::makeDirectory(base_path("resources/views/admin/{$kebabDomain}/{$langModel}"));
        }

        $this->outputFilePath = base_path("resources/views/admin/{$kebabDomain}/{$langModel}/create.blade.php");
        $this->setStubContent('base-admin-layout.create');
        $this->createFromStub($replace);
        $this->createFile();

        $this->outputFilePath = base_path("resources/views/admin/{$kebabDomain}/{$langModel}/index.blade.php");
        if($isFilters) {
            $this->setStubContent('base-admin-layout.index-filter');
        } else {
            $this->setStubContent('base-admin-layout.index');
        }
        $this->createFromStub($replace);
        $this->createFile();

        if($isFilters) {
            if(!File::exists(base_path("resources/views/admin/{$kebabDomain}/{$langModel}/partials"))) {
                File::makeDirectory(base_path("resources/views/admin/{$kebabDomain}/{$langModel}/partials"));
            }

            $this->outputFilePath = base_path("resources/views/admin/{$kebabDomain}/{$langModel}/partials/filters.blade.php");
            $this->setStubContent('base-admin-layout.filters');
            $this->createFromStub($replace);
            $this->createFile();
        }

        $updatedFields = $this->makeFields($camelModel, $isSlug, $isUser, true);
        $replace['{{ slug }}'] = $updatedFields['{{ slug }}'];
        $replace['{{ user }}'] = $updatedFields['{{ user }}'];

        $this->outputFilePath = base_path("resources/views/admin/{$kebabDomain}/{$langModel}/edit.blade.php");
        $this->setStubContent('base-admin-layout.edit');
        $this->createFromStub($replace);
        $this->createFile();

        return self::SUCCESS;
    }

    private function makeFields(
        string $camelModel,
        bool $isSlug,
        bool $isUser,
        bool $isUpdate = false,
    ): array
    {
        $slug = '';
        if($isSlug) {
            $slug = '<x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__(\'common.slug\')"';

            if($isUpdate) {
                $slug .=  '
                            :value="$'.$camelModel.'->slug"';
            }

            $slug .= '
                            id="slug"
                            name="slug"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>';
        }

        $user = '';
        if($isUser) {
            $user = '<x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user"
                            select-name="user_id"';

            if($isUpdate) {
                $user .=  '
                            :selected="$selectedUser"';
            }

            $user .= '
                            route="admin.select-users"
                            :default-option="trans_choice(\'user.choose\', 1)"
                            :label="trans_choice(\'user.users\', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>';
        }

        return [
            '{{ slug }}' => $slug,
            '{{ user }}' => $user
        ];
    }
}
