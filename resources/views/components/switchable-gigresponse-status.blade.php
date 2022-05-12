@props(['gigResponse', 'status', 'component' => 'jet-dropdown-link'])

@unless ($status === 0)

<form method="POST" action="{{ route('gig-responses.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden GigResponse ID -->
    <input type="hidden" name="gig_response_id" value="{{ $gigResponse->id }}">

    <!-- Hidden New Status -->
    <input type="hidden" name="new_status" value="{{ $status }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">

            @switch($status)
            @case(1)
            <!-- Accepted -->
            @if ($status === $gigResponse->status)
            <x-icon.solid.check class="mr-2 w-5 h-5 text-green-600" />
            <div class="truncate text-green-600 font-semibold">{{ __('Accepted') }}</div>
            @else
            <x-icon.solid.check class="mr-2 w-5 h-5 text-gray-400" />
            <div class="truncate text-gray-400">{{ __('Accept') }}</div>
            @endif
            @break

            @case(2)
            <!-- Declined -->
            @if ($status === $gigResponse->status)
            <x-icon.solid.check class="mr-2 w-5 h-5 text-red-600" />
            <div class="truncate text-red-600 font-semibold">{{ __('Declined') }}</div>
            @else
            <x-icon.solid.check class="mr-2 w-5 h-5 text-gray-400" />
            <div class="truncate text-gray-400">{{ __('Decline') }}</div>
            @endif
            @break

            @case(3)
            <!-- Tentative -->
            @if ($status === $gigResponse->status)
            <x-icon.solid.check class="mr-2 w-5 h-5 text-yellow-500" />
            <div class="truncate text-yellow-500 font-semibold">{{ __('Tentative') }}</div>
            @else
            <x-icon.solid.check class="mr-2 w-5 h-5 text-gray-400" />
            <div class="truncate text-gray-400">{{ __('Tentative') }}</div>
            @endif
            @break

            @default
            @endswitch

        </div>
    </x-dynamic-component>
</form>

@endunless
