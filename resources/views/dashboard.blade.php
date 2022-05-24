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

                @unless (auth()->user()->currentTeam->personal_team)
                <x-button.primary-leading-icon class="items-center justify-center"
                                               onclick="window.livewire.emit('openCreateGigSlideOver')"
                                               icon="icon.solid.plus-sm"
                                               color="blue">Add Gig</x-button.primary-leading-icon>
                @endunless
            </x-slot:action>
        </x-page-header.simple-with-image>
    </x-slot:header>

    @unless (auth()->user()->currentTeam->personal_team)

    <div class="grid grid-cols-1 gap-6 lg:grid-flow-col-dense lg:grid-cols-3">

        <div class="space-y-6 lg:col-start-1 lg:col-span-2">

            <!-- Band Members-->
            <x-card label="band-members-title">
                <div class="px-4 py-5 sm:px-6">

                    <div class="grid grid-cols-5 gap-4 py-3">
                        @foreach (auth()->user()->currentTeam->allUsers() as $user)
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

                        @if (Gate::check('addTeamMember', auth()->user()->currentTeam))
                        <a href="{{ route('teams.show', auth()->user()->currentTeam) }}" class="group">
                            <div class="flex flex-col items-center">
                                <div
                                     class="flex items-center justify-center h-12 w-12 md:h-14 md:w-14 rounded-full  border-2 border-gray-300 group-hover:border-gray-400 border-dashed cursor-pointer">
                                    <x-icon.solid.plus
                                                       class="h-10 w-10 text-gray-300 group-hover:text-gray-400" />
                                </div>
                                <div class="hidden sm:flex mt-2">
                                    <p class="text-sm font-medium text-center text-gray-400 group-hover:text-gray-500">
                                        {{ __('Add Member') }}</p>
                                </div>
                            </div>
                        </a>
                        @endif

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

        <!-- Timeline -->
        <x-card label="timeline-title">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900">{{ __('Latest Activities') }}</h2>

                @livewire('activity-timeline')
            </div>
        </x-card>

    </div>

    @else

    <div class="text-center">
        <h3 class="mt-2 text-sm font-medium text-gray-900">
            {{ __('Your personal practice room is still under construction...') }}</h3>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('In the meantime, select an existing band in the navigation menu') }}

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            {{ __(' or get started and') }}
            <a href="{{ route('teams.create') }}"
               class="font-medium text-blue-600 hover:text-blue-700">{{ __('create a new band') }}</a>
            @endcan
            .
        </p>

    </div>

    @endunless

</x-app-layout>
