<x-app-layout>
    <x-slot:header>
        <div class="flex items-center space-x-5">
            {{-- <div class="flex-shrink-0">
                <div class="relative">
                    <img class="h-16 w-16 rounded-full"
                         src="{{ auth()->user()->currentTeam->team_photo_url }}"
            alt="{{ auth()->user()->currentTeam->name }}">
            <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
        </div>
        </div> --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ __('All Your Gigs') }}</h1>
            <p class="text-sm font-medium text-gray-500">{{ __('Get ready for your upcoming gigs.') }}</p>
        </div>
        </div>
        <div
             class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">

            <x-button.primary-leading-icon class="items-center justify-center"
                                           onclick="window.livewire.emit('openCreateGigSlideOver')"
                                           icon="icon.solid.plus-sm"
                                           color="blue">Add Gig</x-button.primary-leading-icon>
        </div>
    </x-slot:header>

    {{-- <div
         class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2"> --}}

    <div
         class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">

            <!-- Gigs -->
            <section aria-labelledby="gigs-title">
                <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        {{-- <div class="px-4 py-5 sm:px-6">
                            <h2 id="gigs-title" class="text-lg font-medium text-gray-900">
                                {{ __('Next Gigs') }}</h2>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Get ready for your upcoming gigs.
                        </p>
                    </div> --}}

                    <div class="bg-white shadow overflow-hidden">
                        @livewire('gigs-index')
                    </div>
                </div>
        </div>
        </section>

    </div>
    </div>
</x-app-layout>
