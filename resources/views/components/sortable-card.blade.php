<div
     {{ $attributes->class('relative py-1 flex items-center space-x-2') }}>

    <a href="#">
        <div wire:sortable-group.handle class="flex-shrink-0 cursor-move -ml-1">
            <x-icon.solid.dots-vertical class="h-5 w-5 text-gray-500 hover:text-gray-700" />
        </div>
    </a>

    <div class="flex-1 min-w-0">
        <a href="#">
            <p class="text-sm font-medium text-gray-700 hover:text-gray-900 truncate">
                {{ $title }}
            </p>
        </a>
        <p class="text-xs text-gray-500 truncate">
            {{ $artist }}
        </p>
    </div>

</div>
