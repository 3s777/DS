@props([
    'id',
    'button_text' => 'Leave a comment'
])

<div {{ $attributes->class([
            'comments-form',
        ])
    }}>
    <div id="{{ $id }}"></div>
    <div class="comments-form__buttons">
        <x-ui.form.group>
            <x-ui.form.button>
                {{ $button_text }}
            </x-ui.form.button>
        </x-ui.form.group>
    </div>
</div>
