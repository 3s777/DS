<div  x-data="{id:'12'}"
      @click="selectRow()"
    {{ $attributes->class([
        'responsive-table__row'
        ])
    }}>
   {{ $slot }}
</div>
