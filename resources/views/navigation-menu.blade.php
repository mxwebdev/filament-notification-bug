<div x-data="{ showMenu: false }" x-on:open-menu.window="showMenu = true">

    <div x-show="showMenu" class="relative z-40 md:hidden" role="dialog" aria-modal="true">
        <div x-show="showMenu"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

        <div class="fixed inset-0 flex z-40">
            <div x-show="showMenu"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gradient-to-b from-gray-800
                 to-gray-700">

                <div x-show="showMenu"
                     x-transition:enter="ease-in-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in-out duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute top-0 right-0 -mr-12 pt-2">
                    <button x-on:click="showMenu =! showMenu" type="button"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Close sidebar</span>
                        <x-icon.outline.x class="h-6 w-6 text-white" />
                    </button>
                </div>

                <div class="flex-shrink-0 flex items-center px-4">
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                         alt="Workflow">
                </div>

                @livewire('team-dropdown')

                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    <nav class="px-2 space-y-1">

                        <x-jet-responsive-nav-link href="{{ route('dashboard') }}"
                                                   icon="icon.outline.home"
                                                   :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('gigs.index') }}"
                                                   icon="icon.outline.ticket"
                                                   :active="request()->routeIs('gigs.*')">
                            {{ __('Gigs') }}
                        </x-jet-responsive-nav-link>

                    </nav>
                </div>
            </div>

            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex-1 flex flex-col min-h-0 bg-gradient-to-b from-gray-800 to-gray-700">
            <div class="flex items-center h-16 flex-shrink-0 px-4">
                <img class="h-8 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                     alt="Workflow">
            </div>

            @livewire('team-dropdown')

            <div class="flex-1 flex flex-col overflow-y-auto">
                <nav class="flex-1 px-2 py-4 space-y-1">

                    <x-jet-nav-link href="{{ route('dashboard') }}"
                                    icon="icon.outline.home"
                                    :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('gigs.index') }}"
                                    icon="icon.outline.ticket"
                                    :active="request()->routeIs('gigs.*')">
                        {{ __('Gigs') }}
                    </x-jet-nav-link>

                </nav>
            </div>
        </div>
    </div>

</div>
