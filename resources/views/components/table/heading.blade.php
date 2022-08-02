@props([
'sortable' => null,
'direction' => null,
])

<th scope="col"
    {{ $attributes->class('text-left text-sm font-semibold text-gray-900') }}>

    @unless ($sortable)
    {{ $slot }}
    @else
    <button class="flex flex-row items-center">
        <span>{{ $slot }}</span>

        <span class="relative flex items-center ml-1">
            @if ($direction === 'asc')
            <x-icon.solid.chevron-up class="h-5 w-5" />
            @elseif ($direction === 'desc')
            <x-icon.solid.chevron-down class="h-5 w-5" />
            {{-- @else
            <div class="flex flex-col -space-y-3">
                <x-icon.solid.chevron-up class="h-5 w-5" />
                <x-icon.solid.chevron-down class="h-5 w-5" />
            </div> --}}
            @endif
        </span>
    </button>
    @endunless

</th>
