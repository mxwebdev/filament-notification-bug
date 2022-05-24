@props(['lastItem', 'color', 'icon', 'date'])

<li>
    <div class="relative pb-8">

        @unless ($lastItem)
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
              aria-hidden="true"></span>
        @endunless

        <div class="relative flex space-x-3">
            <div>
                <span
                      class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white {{ $color }}">

                    <x-dynamic-component :component="$icon" class="w-5 h-5 text-white" />

                </span>
            </div>
            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ $slot }}
                    </p>
                </div>

                @if (isset($date))
                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                    <time datetime="{{ $date->format('Y-m-d') }}">{{ $date->format('M j') }}</time>
                </div>
                @endif

            </div>
        </div>
    </div>
</li>
