<div
     {{ $attributes->class('relative py-1 flex items-center space-x-2') }}>

    <div class="flex-1 min-w-0 pl-1.5">
        <a href="#">
            <p class="text-sm font-medium text-gray-700 hover:text-gray-900 truncate">
                {{ $title }}
            </p>
        </a>
        <p class="text-xs text-gray-500 truncate">
            {{ $artist }}
        </p>
    </div>

    {{ $slot }}

    <a href="#">
        <div class="flex-shrink-0 cursor-move pl-2">
            <x-icon.solid.dots-vertical class="h-5 w-5 text-gray-500 hover:text-gray-700" />
        </div>
    </a>

</div>
