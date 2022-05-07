<div>
    <div x-data class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button x-on:click="$dispatch('open-menu')" type="button"
                class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
            <span class="sr-only">Open sidebar</span>
            <x-icon.outline.menu-alt-2 class="h-6 w-6" />
        </button>
        <div class="flex-1 px-4 flex justify-between">
            <div class="flex-1 flex">
                <form class="w-full flex md:ml-0" action="#" method="GET">
                    <label for="search-field" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                            <x-icon.solid.search class="h-5 w-5" />
                        </div>
                        <input id="search-field"
                               class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                               placeholder="Search" type="search" name="search">
                    </div>
                </form>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <button type="button"
                        class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">{{ __('View notifications') }}</span>
                    <x-icon.outline.bell class="h-6 w-6" />
                </button>

                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button x-on:click="showProfileDropdown =! showProfileDropdown" type="button"
                                    class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">{{ __('Open user menu') }}</span>
                                <img class="h-8 w-8 rounded-full"
                                     src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}">
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="py-1">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Your Profile') }}
                                </x-jet-dropdown-link>
                            </div>

                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>

            </div>
        </div>
    </div>
</div>
