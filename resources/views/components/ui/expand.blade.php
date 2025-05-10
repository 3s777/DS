@props([
    'height' => 100,
    'cssHeight' => 100,
    'hideText' => __('common.hide'),
    'showText' => __('common.show_all'),
    'buttons' => false,
    'buttonClass' => false
])

<div x-data="{
        expanded: false,
        contentHeight: 0,
        cssVar: 0,
        height: 0,
        updateHeight() {
            this.contentHeight = this.$refs.content.scrollHeight;
        },
        init() {
          this.$nextTick(() => this.updateHeight());
          this.cssVar = getComputedStyle(document.body).getPropertyValue('--{{ $cssHeight }}'),
          this.height = parseInt(this.cssVar.slice(0, -2), 10);
          window.addEventListener('resize', () => this.updateHeight());
        }
    }" class="expand__wrapper">
    <div {{ $attributes->class([
                'expand__content',
            ])
        }}
         x-ref="content"
         x-bind:style="expanded ?
             { maxHeight: contentHeight + 'px' } :
             { maxHeight: 'var(--{{ $cssHeight }})' }"
         x-bind:class="[expanded ? 'expand__content_full' : '',
                        contentHeight > height ? 'expand__content_hidden' : '']">
            {{ $slot }}
    </div>

    <div class="expand__content-buttons">
        {{ $buttons }}

        <x-ui.form.button
            x-show="contentHeight > height"
            x-on:click="expanded = !expanded"
            x-text="expanded ? '{{ $hideText }}' : '{{ $showText }}'"
            size="small"
            :class="$buttonClass ? $buttonClass.' expand__content-button' : 'expand__content-button'">
            {{ $showText }}
        </x-ui.form.button>
    </div>
</div>
