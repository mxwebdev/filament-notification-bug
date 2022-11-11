<div>

    <form wire:submit.prevent="callFileMergerApi">

        {{-- Start: Component (x-modal.slideover) --}}
        <div x-data="{ show: @entangle('showSlideOver') }"
             x-show="show"
             x-on:keydown.window.escape="show = false"
             class="fixed z-40 inset-0 overflow-hidden"
             aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div x-show="show"
                     x-transition:enter="ease-in-out duration-500"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in-out duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                     aria-hidden="true"></div>

                <div x-on:click.away="show = false"
                     class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div x-show="show"
                         x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                         x-transition:enter-start="translate-x-full"
                         x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="translate-x-full"
                         class="pointer-events-auto w-screen max-w-md">

                        {{-- Start: Loading --}}
                        <div wire:loading.flex wire:target="callFileMergerApi"
                             class="fixed z-50 h-full w-screen max-w-md overflow-hidden bg-gray-500 bg-opacity-50 flex flex-col justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        {{-- End: Loading --}}

                        <div class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                            <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">

                                            {{-- Start: Title --}}
                                            {{ __('Export setlist') }}
                                            {{-- End: Title --}}

                                        </h2>
                                        <div class="ml-3 flex h-7 items-center">
                                            <button x-on:click="show = false"
                                                    type="button"
                                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                                <span class="sr-only">Close panel</span>
                                                <x-icon.outline.x class="h-6 w-6" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative mt-6 flex-1 px-4 sm:px-6">

                                    {{-- Start: Slot --}}
                                    <div class="grid grid-cols-1 space-y-4">
                                        <div>
                                            <h3 class="text-md font-medium text-gray-700">{{ __('Settings') }}</h3>
                                            <p class="mt-1 text-sm text-gray-500">Configure your setlist the way you
                                                want</p>
                                        </div>

                                        <div class="space-y-3">
                                            <legend class="sr-only">Title page</legend>
                                            <div class="relative flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input wire:model="settings.titlePage" id="title"
                                                           aria-describedby="title-description"
                                                           type="checkbox"
                                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="title" class="text-gray-700">Title page</label>
                                                    <p id="title-description" class="text-sm text-gray-500">Add a title
                                                        page to your
                                                        export</p>
                                                </div>
                                            </div>

                                            <legend class="sr-only">Placeholders</legend>
                                            <div class="relative flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input wire:model="settings.placeholders" id="placeholders"
                                                           aria-describedby="placeholders-description"
                                                           type="checkbox"
                                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="placeholders" class="text-gray-700">Placeholders</label>
                                                    <p id="placeholders-description" class="text-sm text-gray-500">Add
                                                        placeholder for songs
                                                        without uploaded sheets</p>
                                                </div>
                                            </div>

                                            <legend class="sr-only">Double pages</legend>
                                            <div class="relative flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input wire:model="settings.doublePages" id="doublePages"
                                                           aria-describedby="doublePages-description"
                                                           type="checkbox"
                                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="doublePages" class="text-gray-700">Double pages</label>
                                                    <p id="doublePages-description" class="text-sm text-gray-500">Add
                                                        blank pages to single page
                                                        sheets</p>
                                                </div>
                                            </div>
                                        </div class="space-y-3">

                                    </div>
                                    {{-- End: Slot --}}

                                </div>
                            </div>
                            <div class="flex flex-shrink-0 justify-end px-4 py-4">

                                {{-- Start: Footer --}}
                                <x-button.secondary wire:click="closeSlideOver" color="gray">
                                    {{ __('Cancel') }}
                                </x-button.secondary>
                                <x-button.primary type="submit" class="ml-4">
                                    {{ __('Export') }}
                                </x-button.primary>
                                {{-- End:Footer --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End: Component --}}

    </form>
</div>
