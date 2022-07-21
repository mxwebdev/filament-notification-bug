<div wire:loading.class.delay.short="opacity-50 cursor-not-allowed">

    <div wire:sortable="updateSetOrder()" wire:sortable-group="updateSongOrder()"
         class="grid grid-cols-1 sm:grid-cols-4 gap-4">

        {{-- Start: Reportoire --}}
        <div class="col-span-4 sm:col-span-2 xl:col-span-1">

            <x-sortable-container :collapse="false"
                                  wire:key="set-0"
                                  wire:sortable.item="0"
                                  class="border-2">

                <x-slot:title>
                    {{ __('Repertoire') }}
                </x-slot:title>

                <x-slot:subtitle>
                    {{ $rep->count() }} {{ __('Songs') }}
                </x-slot:subtitle>

                {{-- Note: Blade component can't be used due to DOM diffing issue because of x-bind:id="$id('input')" --}}
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="searchTerm" placeholder="{{ __('Search') }}..." type="text" class="shadow-sm
                           block w-full text-sm rounded-md focus:outline-none border-gray-300 focus:ring-indigo-600
                           focus:border-indigo-600" />
                </div>

                <div wire:sortable-group.item-group="0">

                    @foreach ($rep as $song)
                    <x-sortable-card wire:key="song-{{ $song->id }}" wire:sortable-group.item="{{ $song->id }}">
                        <x-slot:title>{{ $song->title }}</x-slot:title>
                        <x-slot:artist>{{ $song->artist }}</x-slot:artist>
                    </x-sortable-card>
                    @endforeach

                </div>

            </x-sortable-container>

        </div>
        {{-- End: Repertoire --}}

        {{-- Start: Sets --}}
        <div
             class="col-span-4 sm:col-span-2 xl:col-span-3 overflow-y-auto flex flex-wrap content-start gap-4">

            @foreach ($gig->sets as $set)
            {{-- class="sm:w-72 sm:max-w-sm" --}}
            <x-sortable-container
                                  wire:key="set-{{ $set->id }}"
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

                    @forelse ($set->songs as $song)
                    <x-sortable-card wire:key="song-{{ $song->id }}" wire:sortable-group.item="{{ $song->id }}">
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

                </div>

            </x-sortable-container>
            @endforeach

        </div>
        {{-- End: Sets --}}

        @livewire('sets-edit')

    </div>
</div>

@push('scripts')
@once
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endonce
@endpush
