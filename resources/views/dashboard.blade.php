<x-app-layout>
    {{-- <x-slot name="header">
        {{ auth()->user()->currentTeam->name }}
    </x-slot> --}}

    {{-- @livewire('gig-calendar') --}}

    <!-- Page header -->

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
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Get ready for your upcoming gigs.</p>
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
                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Timeline</h2>
                tbd
                <!-- Activity Feed -->
                <div class="mt-6 flow-root">
                    {{-- <ul role="list" class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                      aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                              class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                            <!-- Heroicon name: solid/user -->
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Applied to <a href="#"
                                                   class="font-medium text-gray-900">Front End Developer</a></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-20">Sep 20</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                      aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                              class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <!-- Heroicon name: solid/thumb-up -->
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                      d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Advanced to phone screening by <a
                                                   href="#" class="font-medium text-gray-900">Bethany Blake</a></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-22">Sep 22</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                      aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                              class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <!-- Heroicon name: solid/check -->
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Completed phone screening with <a
                                                   href="#" class="font-medium text-gray-900">Martha Gardner</a></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-28">Sep 28</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                      aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                              class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <!-- Heroicon name: solid/thumb-up -->
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                      d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Advanced to interview by <a href="#"
                                                   class="font-medium text-gray-900">Bethany Blake</a></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-30">Sep 30</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                              class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <!-- Heroicon name: solid/check -->
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Completed interview with <a href="#"
                                                   class="font-medium text-gray-900">Katherine Snyder</a></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-10-04">Oct 4</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul> --}}
                </div>
                <div class="mt-6 flex flex-col justify-stretch">
                    {{-- <button type="button"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Advance
                        to offer</button> --}}
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
