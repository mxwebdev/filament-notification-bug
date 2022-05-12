<!-- User account dropdown -->
<div class="px-3 relative inline-block text-left">

    <x-jet-dropdown align="full" width="full">
        <x-slot name="trigger">
            <button type="button"
                    class="group w-full bg-gray-800 rounded-md px-3.5 py-2 text-sm text-left font-medium
                                text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    id="options-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="flex w-full justify-between items-center">
                    <span class="flex min-w-0 items-center justify-between space-x-3">
                        @if (auth()->user()->currentTeam->personal_team)
                        <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                             src="{{ auth()->user()->profile_photo_url }}"
                             alt="{{ auth()->user()->name }}">
                        @else
                        <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                             src="{{ auth()->user()->currentTeam->team_photo_url }}"
                             alt="{{ auth()->user()->currentTeam->name }}">
                        @endif
                        <span class="flex-1 flex flex-col min-w-0">
                            <span
                                  class="text-gray-300 text-sm font-medium truncate">{{ Auth::user()->currentTeam->name }}</span>
                            <span
                                  class="text-gray-500 text-sm
                                              truncate">{{ Auth::user()->currentTeam->name }}</span>
                        </span>
                    </span>
                    <x-icon.solid.selector
                                           class="flex-shrink-0 h-5 w-5 text-gray-500 group-hover:text-gray-300" />
                </span>
            </button>
        </x-slot>

        <x-slot name="content">
            <div class="py-1" role="none">
                <!-- Team Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>
                <!-- Team Settings -->
                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                    {{ __('Team Settings') }}
                </x-jet-dropdown-link>
                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                    {{ __('Create New Team') }}
                </x-jet-dropdown-link>
                @endcan
            </div>
            <div class="py-1" role="none">
                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>
                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" />
                @endforeach
            </div>
        </x-slot>

    </x-jet-dropdown>
</div>
