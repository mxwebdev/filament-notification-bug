<x-app-layout>

    <x-slot:header>
        <x-page-header.simple-with-image :title="auth()->user()->currentTeam->name"
                                         :url="auth()->user()->currentTeam->personal_team ? auth()->user()->profile_photo_url :
                              auth()->user()->currentTeam->team_photo_url"
                                         :alt="auth()->user()->currentTeam->personal_team ? auth()->user()->name :
                              auth()->user()->currentTeam->name">
            <x-slot:subtitle>
                <p class="text-sm text-gray-500">{{ __('tbd') }}</p>
            </x-slot:subtitle>
            <x-slot:action>
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
            </x-slot:action>
        </x-page-header.simple-with-image>
    </x-slot:header>

    <div class="grid grid-cols-1 gap-6 lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">

            <!-- Band Members-->
            <x-card label="band-members-title">
                <div class="px-4 py-5 sm:px-6">

                    <div class="grid grid-cols-5 gap-4 py-3">
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
            </x-card>

            <!-- Upcoming Gigs -->
            <x-card label="upcoming-gigs-title">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">{{ __('Next Gigs') }}
                    </h2>
                    {{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{ __('Get ready for your upcoming gigs.') }}</p> --}}
                </div>

                @livewire('upcoming-gigs')
            </x-card>
        </div>

        <x-card label="timeline-title">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900">{{ __('Latest Activities') }}</h2>

                @livewire('activity-timeline')
            </div>
        </x-card>
    </div>
</x-app-layout>
