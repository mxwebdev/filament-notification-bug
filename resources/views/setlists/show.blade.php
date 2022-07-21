<x-app-layout>
    <x-slot:header>
        <x-page-header.simple>

            <x-slot:title>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $gig->name }}
                    <x-badge.sm class="ml-2 align-middle" color="{{ App\Models\Gig::STATUS_COLOR[$gig->status] }}">
                        {{ App\Models\Gig::STATUS[$gig->status] }}
                    </x-badge.sm>
                </h2>
            </x-slot:title>

            <x-slot:subtitle>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.location-marker class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ $gig->location }}
                </div>

                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.calendar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ $gig->gig_start->toFormattedDateString() }}
                </div>

                @if ($gig->fee)
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.currency-dollar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ number_format($gig->fee, 0, ',', '.') }}
                </div>
                @endif
            </x-slot:subtitle>

            <x-slot:action>
                <div class="flex space-x-4">
                    <x-button.primary-leading-icon onclick="window.livewire.emit('addSet')"
                                                   icon="icon.solid.plus-sm"
                                                   color="blue">
                        {{ __('Add Set') }}
                    </x-button.primary-leading-icon>
                </div>
            </x-slot:action>

        </x-page-header.simple>
    </x-slot:header>

    @livewire('setlist-builder', ['gig' => $gig])

</x-app-layout>
