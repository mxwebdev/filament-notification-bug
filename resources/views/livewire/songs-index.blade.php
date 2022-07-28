<div>
    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        {{ __('Title') }}
                    </th>
                    <th scope="col"
                        class="px-3 py-3 text-left text-sm font-semibold text-gray-900">
                        {{ __('Artist') }}
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        {{ __('Key') }}
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                        {{ __('BPM') }}
                    </th>
                    <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">{{ __('Edit') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">

                @foreach ($songs as $song)
                <tr>
                    <td class="whitespace-nowrap py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                        {{ $song->title }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">
                        {{ $song->artist }}
                    </td>
                    <td class="hidden whitespace-nowrap px-3 py-3 text-sm text-gray-500 sm:table-cell">
                        {{ $song->song_key }}
                    </td>
                    <td class="hidden whitespace-nowrap px-3 py-3 text-sm text-gray-500 lg:table-cell">
                        {{ $song->bpm }}
                    </td>
                    <td class="whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <a href="#" wire:click="editSong({{ $song }})"
                           class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}<span
                                  class="sr-only">,
                                {{ $song->title }}</span></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    {{ $songs->links('pagination') }}

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

            </div>

            <x-slot:footer>
                <x-button.secondary wire:click="closeSlideOver" color="gray">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary type="submit" class="ml-4">{{ __('Save') }}</x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
