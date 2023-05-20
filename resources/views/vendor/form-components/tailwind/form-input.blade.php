<div class="@if($type === 'hidden') hidden @else mt-4 @endif">
    <label class="block">
        <x-form-label :label="$label" />

        <input {!! $attributes->merge([
            'class' => 'form-input block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ' . ($label ? 'mt-1' : '')
        ]) !!}
            @if($isWired())
                wire:model{!! $wireModifier() !!}="{{ $name }}"
            @else
                value="{{ $value }}"
            @endif

            name="{{ $name }}"
            type="{{ $type }}" />
    </label>

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
