@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])

@php
switch ($align) {
case 'left':
$alignmentClasses = 'origin-top-left left-0';
break;
case 'full':
$alignmentClasses = 'origin-top right-0 left-0';
break;
case 'top':
$alignmentClasses = 'origin-top';
break;
case 'none':
case 'false':
$alignmentClasses = '';
break;
case 'right':
default:
$alignmentClasses = 'origin-top-right right-0';
break;
}

switch ($width) {
case '48':
$width = 'w-48';
case 'full':
$width = '';
break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }} {{ $dropdownClasses }}"
         style="display: none;"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="user-menu-button"
         tabindex="-1"
         @click="open = false">
        <div
             class="rounded-md ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-200 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
