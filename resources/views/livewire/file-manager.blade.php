<div>
    <x-filepond wire:model="uploadedFile" />

    @if (filled($song))

    <div class="flex flex-col py-2 space-y-2">
        @foreach ($song->files as $file)

        <x-file-card wire:click="attachFileToUser({{ $file }})" :selected="$file->users->contains(auth()->user())">

            <x-slot:title>
                {{ __('Upload by') }} {{ $file->owner->name }}
            </x-slot:title>

            <x-slot:subtitle>
                {{ $file->created_at->diffForHumans() }}
            </x-slot:subtitle>

            <x-slot:users>
                @foreach ($file->users as $user)
                <img class="inline-block h-7 w-7 rounded-full ring-2 ring-white"
                     src="{{ $user->profile_photo_url }}"
                     alt="{{ $user->name }}" />
                @endforeach
            </x-slot:users>

            <x-slot:action>
                {{-- <a href="#" wire:click="test">
                    <x-icon.outline.eye class="h-6 w-6 text-gray-400 hover:text-gray-700" />
                </a>
                <a href="#" wire:click="test">
                    <x-icon.outline.trash class="h-6 w-6 text-gray-400 hover:text-gray-700" />
                </a> --}}
            </x-slot:action>
        </x-file-card>

        @endforeach
    </div>

    @endif
</div>
