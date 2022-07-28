<div wire:loading.class.delay.short="opacity-50 cursor-not-allowed">

    <div wire:sortable="updateSetOrder"
         wire:sortable-group="updateSongOrder"
         class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="col-span-full flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 sm:text-xl">{{ __('Repertoire') }}</h3>
                <p class="text-sm text-gray-500">{{ $rep->count() }} {{ __('Songs') }}</p>
            </div>
            <div class="relative rounded-md shadow-sm">
                {{-- Note: Blade component can't be used due to DOM diffing issue because of x-bind:id="$id('input')" --}}
                <input wire:model="searchTerm" placeholder="{{ __('Search repertoire') }}..." type="text" class="shadow-sm
                           block w-64 text-sm rounded-md focus:outline-none border-gray-300 focus:ring-indigo-600
                           focus:border-indigo-600" />
            </div>
        </div>

        {{-- Start: Repertoire --}}
        <x-sortable-container class="col-span-full">

            <div wire:sortable-group.item-group="0"
                 wire:sortable-group.options="{ ghostClass: 'sortable-ghost', dragClass: 'sortable-drag'}"
                 class="h-64 overflow-y-scroll">

                @forelse ($rep as $song)
                <x-sortable-card wire:key="song-{{ $song->id }}" wire:sortable-group.item="{{ $song->id }}">
                    <x-slot:title>{{ $song->title }}</x-slot:title>
                    <x-slot:artist>{{ $song->artist }}</x-slot:artist>
                </x-sortable-card>
                @empty
                <div class="relative flex items-center justify-center h-full">
                    <p class="text-sm py-4 font-medium text-gray-500">
                        {{ __('There is no song matching your search...') }}
                    </p>
                </div>
                @endforelse

            </div>

        </x-sortable-container>
        {{-- End: Repertoire --}}

        <div class="col-span-full flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 sm:text-xl">{{ __('Sets') }}</h3>
                <p class="text-sm text-gray-500">{{ __('Songs') }}</p>
            </div>

            <x-button.secondary wire:click="$toggle('isCollapsed')"
                                color="blue">
                @if ($isCollapsed)
                {{ __('Extend Sets') }}
                @else
                {{ __('Collapse Sets') }}
                @endif
            </x-button.secondary>
        </div>

        {{-- Start: Sets --}}
        @foreach ($gig->sets as $set)
        <x-sortable-container wire:key="set-{{ $set->id }}"
                              wire:sortable.item="{{ $set->id }}">

            <x-slot:title>
                <span class="cursor-move" wire:sortable.handle>{{ $set->name }}</span>
                <a href="#" wire:click="$emitTo('sets-edit', 'openEditSetSlideOver', {{ $set->id }})">
                    <x-icon.solid.pencil class="ml-2 h-5 w-5 text-gray-500 hover:text-gray-700" />
                </a>
            </x-slot:title>

            <x-slot:subtitle>
                {{ $set->songs->count() }} {{ __('Songs') }}
            </x-slot:subtitle>

            <div wire:sortable-group.item-group="{{ $set->id }}">

                @if($isCollapsed)
                <div class="relative flex items-center justify-center h-full">
                    <p class="text-sm py-4 font-medium text-gray-500">
                        Dropzone 🪂
                    </p>
                </div>
                @else

                @forelse ($set->songs as $song)
                <x-sortable-card wire:key="song-{{ $song->id }}"
                                 wire:sortable-group.item="{{ $song->id }}">
                    <x-slot:title>{{ $song->title }}</x-slot:title>
                    <x-slot:artist>{{ $song->artist }}</x-slot:artist>
                </x-sortable-card>
                @empty
                <div class="relative flex items-center justify-center h-full">
                    <p class="text-sm py-4 font-medium text-gray-500">
                        Drop it like it's hot 🔥
                    </p>
                </div>
                @endforelse

                @endif

            </div>

        </x-sortable-container>
        @endforeach
        {{-- End: Sets --}}

        @livewire('sets-edit')

    </div>
</div>
