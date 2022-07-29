@props(['selected'])

<div
     {{ $attributes->class(['py-1.5 px-2 flex items-center justify-between space-x-2 rounded-md group cursor-pointer hover:bg-gray-50',
                            'border-2 border-gray-300 border-dashed bg-gray-50' => $selected]) }}>

    <div class="flex-shrink-0 cursor-move -ml-1">
        <x-icon.outline.document-text class="h-6 w-6 text-gray-500 group-hover:text-gray-700" />
    </div>

    <div class="flex-1 min-w-0">
        <a href="#">
            <p class="text-sm text-gray-700 group-hover:text-gray-900 truncate">
                {{ $title }}
            </p>
        </a>
        <p class="text-xs text-gray-500 group-hover:text-gray-700 truncate">
            {{ $subtitle }}
        </p>
    </div>

    <div class="flex overflow-hidden -space-x-1">
        {{ $users }}
    </div>

    <div class="flex space-x-1">
        {{ $action }}
    </div>

</div>
