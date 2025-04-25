@if(app()->getLocale() == 'ru')
    <x-svg.ruble class="button__submit-icon"></x-svg.ruble>
@else
    <x-svg.dollar class="button__submit-icon"></x-svg.dollar>
@endif

