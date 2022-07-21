<div>

    <form wire:submit.prevent="save">
        <x-modal.slideover>

            <x-slot:title>
                {{ __('Edit set') }}
            </x-slot:title>

            <div class="grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Details') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Enter your set details below.</p>
                </div>

                <x-input.group label="{{ __('Name') }}" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" placeholder="{{ __('New Set') }}" />
                </x-input.group>
                <x-button.primary wire:click="deleteSet()" color="red">
                    {{ __('Delete Set') }}
                </x-button.primary>
            </div>

            <x-slot:footer>
                <x-button.secondary wire:click="closeSlideOver" color="gray">
                    {{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary type="submit" class="ml-4">
                    {{ __('Save') }}
                </x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
