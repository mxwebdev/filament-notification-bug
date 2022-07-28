<div {{ $attributes->class('flex-auto flex flex-col space-y-2 p-2 rounded-md border border-gray-300') }}>

    @if (isset($title) | isset($subtitle))
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
            {{-- Add delete set button --}}
        </div>
    </div>
    @endif

    <div class="space-y-1">

        {{ $slot }}

    </div>
</div>
