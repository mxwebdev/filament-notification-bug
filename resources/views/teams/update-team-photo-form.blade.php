<x-jet-form-section submit="updateTeamPhoto">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Team Photo File Input -->
            <input type="file" class="hidden"
                   wire:model="photo"
                   x-ref="photo"
                   x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Team Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->team->team_photo_url }}" alt="{{ $this->team->name }}"
                     class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Team Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            @if (Gate::check('update', $team))
            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>

            @if ($this->team->team_photo_path)
            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteTeamPhoto">
                {{ __('Remove Photo') }}
            </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
            @endif
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
    @endif
</x-jet-form-section>
