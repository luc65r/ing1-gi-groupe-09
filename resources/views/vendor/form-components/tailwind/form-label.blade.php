@if($label)
    <span {!! $attributes->merge(['class' => 'font-medium text-sm text-gray-700']) !!}>{{ $label }}</span>
@endif
