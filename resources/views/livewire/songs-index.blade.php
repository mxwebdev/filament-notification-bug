<div>
    <div class="flex py-4">
        <x-input.text wire:model="filters.search" class="w-64" placeholder="{{ __('Search songs...') }}" />
    </div>

    <div class="overflow-hidden shadow bg-white ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-t-lg">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <x-table.heading sortable
                                     :direction="$sorts['title'] ?? null"
                                     wire:click="sortBy('title')"
                                     scope="col"
                                     class="py-3 pl-4 pr-3 sm:pl-6">
                        {{ __('Title') }}
                    </x-table.heading>
                    <x-table.heading sortable
                                     :direction="$sorts['artist'] ?? null"
                                     wire:click="sortBy('artist')"
                                     scope="col"
                                     class="px-3 py-3">
                        {{ __('Artist') }}
                    </x-table.heading>
                    <x-table.heading scope="col"
                                     class="hidden px-3 py-3 lg:table-cell">
                        {{ __('Key') }}
                    </x-table.heading>
                    <x-table.heading scope="col"
                                     class="hidden px-3 py-3 lg:table-cell">
                        {{ __('BPM') }}
                    </x-table.heading>
                    <x-table.heading scope="col"
                                     class="px-3 py-3">
                        {{ __('Sheets') }}
                    </x-table.heading>
                    <x-table.heading scope="col"
                                     class="relative py-3 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">{{ __('Edit') }}</span>
                    </x-table.heading>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">

                @foreach ($songs as $song)
                <tr>
                    <x-table.cell class="py-3 pl-4 pr-3 font-medium text-gray-900 sm:pl-6">
                        {{ $song->title }}
                    </x-table.cell>
                    <x-table.cell class="px-3 py-3">
                        {{ $song->artist }}
                    </x-table.cell>
                    <x-table.cell class="hidden px-3 py-3 lg:table-cell">
                        {{ $song->song_key }}
                    </x-table.cell>
                    <x-table.cell class="hidden px-3 py-3 lg:table-cell">
                        {{ $song->bpm }}
                    </x-table.cell>
                    <x-table.cell class="px-3 py-3">
                        <div class="flex overflow-hidden -space-x-1">
                            @foreach ($song->files as $file)
                            <img class="inline-block h-7 w-7 rounded-full ring-2 ring-white"
                                 src="{{ $file->owner->profile_photo_url }}"
                                 alt="{{ $file->owner->name }}">
                            @endforeach
                        </div>
                    </x-table.cell>
                    <x-table.cell class="py-3 pl-3 pr-4 text-right font-medium sm:pr-6">
                        <a href="#" wire:click="editSong({{ $song }})"
                           class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}<span
                                  class="sr-only">,
                                {{ $song->title }}</span></a>
                    </x-table.cell>
                </tr>
                @endforeach

            </tbody>
        </table>

        {{ $songs->links('pagination') }}

    </div>

    <form wire:submit.prevent="save">
        <x-modal.slideover>
            <x-slot:title>
                {{ __('Add song') }}
            </x-slot:title>

            <div class="grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Details') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Enter your song details.</p>
                </div>

                <x-input.group label="{{ __('Title') }}" :error="$errors->first('editing.title')">
                    <x-input.text wire:model.defer="editing.title" placeholder="{{ __('Bohemian Rhapsody') }}" />
                </x-input.group>

                <x-input.group label="{{ __('Artist') }}" :error="$errors->first('editing.artist')">
                    <x-input.text wire:model.defer="editing.artist" placeholder="{{ __('Queen') }}" />
                </x-input.group>

                <div class="grid grid-cols-2 space-x-4">
                    <x-input.group label="{{ __('Key') }}" :error="$errors->first('editing.song_key')">
                        <x-input.text wire:model.defer="editing.song_key" placeholder="{{ __('C Minor') }}" />
                    </x-input.group>

                    <x-input.group label="{{ __('BPM') }}" :error="$errors->first('editing.bpm')">
                        <x-input.text type="number" wire:model.defer="editing.bpm" placeholder="{{ __('144') }}" />
                    </x-input.group>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Sheets') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload your sheets.</p>
                </div>

                {{-- @livewire('file-manager', ['song' => $song], key(now())) --}}
                <livewire:file-manager key="{{ now() }}" :song="$editing" />

            </div>
            <x-slot:footer>
                <x-button.secondary wire:click="closeSlideOver" color="gray">{{ __('Cancel') }}</x-button.secondary>
                <x-button.primary type="submit" class="ml-4">{{ __('Save') }}</x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
