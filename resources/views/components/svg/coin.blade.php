@if(app()->getLocale() == 'ru')
    <x-svg.ruble class="button__submit-icon"></x-svg.ruble>
@else
    <x-svg.dollar-coin class="button__submit-icon"></x-svg.dollar-coin>
@endif

