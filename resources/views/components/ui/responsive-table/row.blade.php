<div
{{--        x-data="{ isActive: false }"--}}
{{--      @click="selectRow, isActive = ! isActive"--}}
{{--      :class="isActive ? 'responsive-table__row_active' : ''"--}}
    {{ $attributes->class([
        'responsive-table__row'
        ])
    }}>
   {{ $slot }}
</div>
