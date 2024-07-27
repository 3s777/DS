<x-admin.crud-filters search-placeholder="{{ __('game_developer.search') }}">
    <x-admin.crud-filters-form>
        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates />
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates direction="to" />
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col xl="3" lg="4" md="6" sm="12">

                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-genres"
                        id="genres"
                        name="filters[genres][]"
                        :error="$errors->has('genres')"
                        label="{{ __('game_genre.choose') }}" multiple="">
                        <x-ui.form.option value="">{{ __('game_genre.genre') }}</x-ui.form.option>
                        @foreach($genres as $genre)
                            <x-ui.form.option
                                value="{{ $genre['id'] }}"
                                :selected="request('filters.genres') && in_array($genre['id'], request('filters.genres'))">
                                {{ $genre['name'] }}
                            </x-ui.form.option>
                        @endforeach
                    </x-libraries.choices>
                </x-ui.form.group>

        </x-grid.col>


        <x-grid.col xl="3" lg="4" md="6" sm="12">

            <x-ui.form.group>
                <x-libraries.choices
                    class="choices-platforms"
                    id="platforms"
                    name="filters[platforms][]"
                    :error="$errors->has('platforms')"
                    label="{{ __('game_platform.choose') }}" multiple="">
                    <x-ui.form.option value="">{{ __('game_platform.platform') }}</x-ui.form.option>
                    @foreach($platforms as $platform)
                        <x-ui.form.option
                            value="{{ $platform['id'] }}"
                            :selected="request('filters.platforms') && in_array($platform['id'], request('filters.platforms'))">
                            {{ $platform['name'] }}
                        </x-ui.form.option>
                    @endforeach
                </x-libraries.choices>
            </x-ui.form.group>

        </x-grid.col>
        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.async-select
                    :selected="get_filter('user')->relatedModel ?? false"
                    :show-old="false"
                    name="user"
                    label="{{ __('user.user') }}"
                    defaultOption="{{ __('user.choose') }}"
                    selectName="filters[user]"
                    route="select-users"></x-ui.async-select>
            </x-ui.form.group>
        </x-grid.col>

{{--        @foreach(filters() as $filter)--}}
{{--        {!! $filter !!}--}}
{{--        @endforeach--}}

        <x-slot:buttons></x-slot:buttons>
    </x-admin.crud-filters-form>
</x-admin.crud-filters>
