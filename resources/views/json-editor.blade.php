<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div class="w-full"
         x-load-css="['{{ asset('css/InvadersXX/filament-jsoneditor/filament-jsoneditor.css') }}']"
         x-ignore
         x-cloak
         wire:ignore
         ax-load="visible"
         ax-load-src="{{ asset('js/InvadersXX/filament-jsoneditor/filament-jsoneditor.js') }}"
         x-data="{
            state: $wire.entangle('{{ $getStatePath() }}'),
            isJson: {{ json_encode($getJsonFormatted()) }},
            modes: {{ $getModes() }},
        }">
        <div x-ref="editor" class="w-full ace_editor" style="min-height: 30vh;height:{{ $getHeight() }}px"></div>
    </div>
</x-forms::field-wrapper>
