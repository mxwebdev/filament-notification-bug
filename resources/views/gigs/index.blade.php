<x-app-layout>

    <x-slot:header>
        <x-page-header.simple>
            <x-slot:title>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ __('Gigs') }}</h2>
            </x-slot:title>
            <x-slot:subtitle>
                <p class="mt-2 text-sm text-gray-500">{{ __('Get ready for your upcoming gigs.') }}
                </p>
            </x-slot:subtitle>
            <x-slot:action>
                <x-button.primary-leading-icon class="items-center justify-center"
                                               onclick="window.livewire.emit('openCreateGigSlideOver')"
                                               icon="icon.solid.plus"
                                               color="blue">Add Gig</x-button.primary-leading-icon>
            </x-slot:action>
        </x-page-header.simple>
    </x-slot:header>

    @livewire('gigs-index')

    </div>
    </div>
</x-app-layout>
