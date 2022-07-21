@props(['collapse' => true])

<div x-data="{ expanded: true }"
     {{ $attributes->class('flex-auto flex flex-col space-y-2 p-2 rounded-md border border-gray-300') }}>

    <div class="flex items-center justify-between">

        <div>
            @if (isset($title))
            <p class="text-lg leading-tight font-semibold text-gray-900 flex items-center">
                {{ $title }}
            </p>
            @endif

            @if (isset($subtitle))
            <p class="text-sm text-gray-500">
                {{ $subtitle }}
            </p>
            @endif
        </div>

        <div>
            @if ($collapse)
            <a href="#" x-on:click="expanded = ! expanded">
                <div>
                    <x-icon.solid.chevron-down x-show="!expanded" class="h-5 w-5 text-gray-500 hover:text-gray-700" />
                    <x-icon.solid.chevron-up x-show="expanded" class="h-5 w-5 text-gray-500 hover:text-gray-700" />
                </div>
            </a>
            @endif
        </div>

    </div>

    <div x-show="expanded" x-collapse class="space-y-1">

        {{ $slot }}

    </div>
</div>
