<x-app-layout>

    <x-slot:header>
        <x-page-header.simple title="{{ __('Gigs') }}">
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

    <div class="grid grid-cols-1 gap-6 lg:grid-flow-col-dense">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">

            <!-- Gigs -->
            <x-card label="gigs-title">
                <div class="divide-y divide-gray-200">
                    <div class="bg-white shadow overflow-hidden">
                        @livewire('gigs-index')
                    </div>
                </div>
            </x-card>

        </div>
    </div>
</x-app-layout>
