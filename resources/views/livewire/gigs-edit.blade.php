<div>
    <form wire:submit.prevent="save">
        <x-modal.slideover>

            <x-slot:title>
                {{ __('Add gig') }}
            </x-slot:title>

            <div class="grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Details') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Enter your gig details below.</p>
                </div>

                <x-input.group label="{{ __('Name') }}" :error="$errors->first('gig.name')">
                    <x-input.text wire:model.defer="gig.name" placeholder="{{ __('Tour Opening') }}" />
                </x-input.group>

                <x-input.group label="{{ __('Location') }}" :error="$errors->first('gig.location')">
                    <x-input.text wire:model.defer="gig.location" placeholder="{{ __('Royal Albert Hall') }}" />
                </x-input.group>

                <x-input.group label="{{ __('Date') }}" :error="$errors->first('gig.gig_start')">
                    <x-input.text type="date" wire:model.defer="gig.gig_start" />
                </x-input.group>

                <div class="grid grid-cols-2 space-x-4">
                    <x-input.group label=" {{ __('Fee') }}" :error="$errors->first('gig.fee')">
                        <x-input.money wire:model.defer="gig.fee" placeholder="1000" symbol="€" currency="EUR" />
                    </x-input.group>

                    <x-input.group label=" {{ __('Status') }}" :error="$errors->first('gig.status')">
                        <x-input.select wire:model.defer="gig.status">

                            @foreach (App\Models\Gig::STATUS as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach

                        </x-input.select>
                    </x-input.group>
                </div>

            </div>

            <div class="grid grid-cols-1 space-y-6 mt-8">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Line Up') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">An invitation will be sent to all selected musicians after you
                        saved the gig.
                    </p>
                </div>

                <ul role="list" class="divide-y divide-gray-200">
                    @foreach (auth()->user()->currentTeam->allUsers() as $user)
                    <li class="py-3 flex items-center justify-between space-x-3">
                        <div class="min-w-0 flex-1 flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-9 w-9 rounded-full"
                                     src="{{ $user->profile_photo_url }}"
                                     alt="">
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-700 truncate">{{ $user->name }}</p>
                                <p class="text-xs font-medium text-gray-500 truncate">tbd - instruments</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            @if (!in_array($user->id, $invitedUsers))
                            <button wire:click="toggleInvitedUser({{ $user->id }})"
                                    type="button"
                                    class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <x-icon.solid.plus-sm class="-ml-1 mr-0.5 h-5 w-5 text-gray-400" />
                                <span class="text-sm font-medium text-gray-700"> {{ __('Invite') }} <span
                                          class="sr-only">{{ $user->name }}</span> </span>
                            </button>
                            @else
                            <button disabled wire:click="toggleInvitedUser({{ $user->id }})"
                                    type="button"
                                    class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-green-200 hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <x-icon.solid.check class="-ml-1 mr-0.5 h-5 w-5 text-green-700" />
                                <span class="text-sm font-medium text-green-800"> {{ __('Invited') }} <span
                                          class="sr-only">{{ $user->name }}</span> </span>
                            </button>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>

            <x-slot:footer>
                <x-button.secondary wire:click="closeSlideOver" color="gray">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary type="submit" class="ml-4">{{ __('Save & Send Invites') }}</x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
