<div>

    <form wire:submit.prevent="callFileMergerApi">
        <x-modal.slideover>

            <x-slot:title>
                {{ __('Export setlist') }}
            </x-slot:title>

            <div class="grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Settings') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Configure your setlist the way you want</p>
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
                            <p id="title-description" class="text-sm text-gray-500">Add a title page to your
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
                            <p id="placeholders-description" class="text-sm text-gray-500">Add placeholder for songs
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
                            <p id="doublePages-description" class="text-sm text-gray-500">Add blank pages to single page
                                sheets</p>
                        </div>
                    </div>
                </div class="space-y-3">

                {{-- <x-input.group label="{{ __('Name') }}" :error="$errors->first('editing.name')">
                <x-input.text wire:model.defer="editing.name" placeholder="{{ __('New Set') }}" />
                </x-input.group> --}}

                <div wire:loading wire:target="callFileMergerApi">
                    <h3 class="text-md font-medium text-gray-700">Your setlist is being generated... </h3>
                </div>
            </div>

            <x-slot:footer>
                <x-button.secondary wire:click="closeSlideOver" color="gray">
                    {{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary type="submit" class="ml-4">
                    {{ __('Export') }}
                </x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
