<x-app-layout>
    <x-slot:header>
        <div class="flex items-center space-x-5">
            <div class="flex-shrink-0">
                <div class="relative">
                    <img class="h-16 w-16 rounded-full"
                         src="{{ auth()->user()->currentTeam->team_photo_url }}"
                         alt="{{ auth()->user()->currentTeam->name }}">
                    <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ auth()->user()->currentTeam->name }}</h1>
                <p class="text-sm font-medium text-gray-500">tbd</p>
            </div>
        </div>
        <div
             class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">

            <form action="{{ route('teams.show', ['team' => auth()->user()->currentTeam->id]) }}">
                <x-button.secondary-leading-icon type="submit" class="items-center justify-center"
                                                 icon="icon.outline.cog"
                                                 color="blue">{{ __('Team Settings') }}
                </x-button.secondary-leading-icon>
            </form>

            <x-button.primary-leading-icon class="items-center justify-center"
                                           onclick="window.livewire.emit('openCreateGigSlideOver')"
                                           icon="icon.solid.plus-sm"
                                           color="blue">Add Gig</x-button.primary-leading-icon>
        </div>
    </x-slot:header>

    <div
         class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
            <!-- Band Members-->
            <section aria-labelledby="band-members-title">
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6">

                        <div class="grid grid-cols-5 gap-4">
                            @foreach (auth()->user()->currentTeam->users as $user)
                            <div class="flex flex-col items-center">
                                <img class="h-12 w-12 md:h-14 md:w-14 rounded-full"
                                     src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->name }}">
                                <div class="hidden sm:flex mt-2">
                                    <p class="text-sm font-medium text-center text-gray-700 group-hover:text-gray-900">
                                        {{ $user->name }}</p>
                                    {{-- <p class="text-xs font-medium text-center text-gray-500 group-hover:text-gray-700">
                                        tbd
                                    </p> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>

            <!-- Upcoming Gigs -->
            <section aria-labelledby="upcoming-gigs-title">
                <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 id="upcoming-gigs-title" class="text-lg font-medium text-gray-900">
                                {{ __('Next Gigs') }}</h2>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{ __('Get ready for your upcoming gigs.') }}</p>
                        </div>

                        <div class="bg-white shadow overflow-hidden">
                            @livewire('upcoming-gigs')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">{{ __('Latest Activities') }}</h2>

                @livewire('activity-timeline')
            </div>
        </section>
    </div>
</x-app-layout>
