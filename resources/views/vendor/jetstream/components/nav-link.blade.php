@props(['icon', 'active'])

@php
$classes = ($active ?? false)
? 'bg-gray-900 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md'
: 'text-gray-300 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-700 hover:text-white';

$iconClasses = ($active ?? false)
? 'text-gray-300 mr-3 flex-shrink-0 h-6 w-6'
: 'text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0 h-6 w-6';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <x-dynamic-component :component="$icon" class="{{ $iconClasses }}" />
    {{ $slot }}
</a>
