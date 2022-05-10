<div>
    <h2 class="text-lg font-semibold text-gray-900">{{ __('Upcoming gigs') }}</h2>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-16">
        <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
            <div class="flex items-center text-gray-900">
                <button wire:click="prevMonth" type="button"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Previous month</span>
                    <x-icon.solid.chevron-left class="h-5 w-5" />
                </button>

                <div class="flex-auto font-semibold">{{ $selectedDate->format('F') }}</div>

                <button wire:click="nextMonth" type="button"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Next month</span>
                    <x-icon.solid.chevron-right class="h-5 w-5" />
                </button>
            </div>
            <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
                <div>M</div>
                <div>T</div>
                <div>W</div>
                <div>T</div>
                <div>F</div>
                <div>S</div>
                <div>S</div>
            </div>

            <div
                 class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">

                @foreach ($selectedDateRange as $date)

                <button wire:click="setSelectedDate('{{ $date->format('Y-m-d') }}')"
                        type="button"
                        @class([ 'py-1.5 hover:bg-gray-100 focus:z-10' , 'bg-white'=> $date->isSameMonth($selectedDate),
                    'bg-gray-50' => !$date->isSameMonth($selectedDate),
                    'font-semibold' => $date->isSameDay($selectedDate) or $date->isSameDay(Carbon\Carbon::now()),
                    'text-white' => $date->isSameDay($selectedDate),
                    'text-gray-900' => !$date->isSameDay($selectedDate) and
                    !$date->isSameDay(Carbon\Carbon::now()) and $date->isSameMonth($selectedDate),
                    'text-gray-400' => !$date->isSameDay($selectedDate) and
                    !$date->isSameDay(Carbon\Carbon::now()) and !$date->isSameMonth($selectedDate),
                    'text-indigo-600' => !$date->isSameDay($selectedDate) and
                    $date->isSameDay(Carbon\Carbon::now()),
                    'rounded-tl-lg' => $loop->first,
                    'rounded-tr-lg' => $loop->index == 6,
                    'rounded-bl-lg' => $loop->remaining == 6,
                    'rounded-br-lg' => $loop->last,
                    ])>

                    {{-- <div class="bg-red-500 h-2 w-2 absolute rounded ml-1"></div> --}}

                    <time datetime="{{ $date->format('Y-m-d') }}"
                          @class([ 'mx-auto flex h-7 w-7 items-center justify-center rounded-full' , 'bg-indigo-600'=>
                        $date->isSameDay($selectedDate) and $date->isSameDay(Carbon\Carbon::now()),
                        'bg-gray-900' => $date->isSameDay($selectedDate) and !$date->isSameDay(Carbon\Carbon::now()),
                        ])>{{ $date->format('j') }}</time>
                </button>

                @endforeach

            </div>
            <button wire:click="$toggle('showSlideOver')" type="button"
                    class="focus:outline-none mt-8 w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{ __('Add gig') }}</button>
        </div>

        <div class="mt-10 text-sm leading-6 lg:col-span-7 xl:col-span-8">

            <div class="bg-white shadow overflow-hidden sm:rounded-md">

                <ul role="list" class="divide-y divide-gray-200">

                    @foreach ($gigs as $gig)
                    <li>
                        <a href="{{ route('gigs.show', $gig) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div class="truncate">
                                        <div class="flex text-sm">
                                            <p class="font-medium text-indigo-600 truncate">{{ $gig->name }}</p>
                                            <p class="ml-1 flex-shrink-0 italic font-normal text-gray-500">
                                                {{ __('created by') }} {{ $gig->creator->name }}</p>
                                        </div>
                                        <div class="mt-2 flex">

                                            <div class="flex items-start space-x-2 text-gray-500">
                                                <dt class="mt-0.5">
                                                    <span class="sr-only">Date</span>
                                                    <!-- Heroicon name: solid/calendar -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                         fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                </dt>
                                                <dd><time
                                                          datetime="{{ $gig->gig_start }}">{{ $gig->gig_start->toFormattedDateString() }}</time>
                                                </dd>
                                            </div>
                                            <div
                                                 class="flex ml-4 items-start space-x-1 text-gray-500">
                                                <dt class="mt-0.5">
                                                    <span class="sr-only">Location</span>
                                                    <!-- Heroicon name: solid/location-marker -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                         fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                              d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                </dt>
                                                <dd>{{ $gig->location }}</dd>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                        <div class="flex overflow-hidden -space-x-1">

                                            @foreach ($gig->gigResponses as $gigResponse)
                                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                                                 src="{{ $gigResponse->user->profile_photo_url }}"
                                                 alt="{{ $gigResponse->user->name }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach

                </ul>

            </div>

        </div>

    </div>

    <form wire:submit.prevent="save">
        <x-modal.slideover>
            <x-slot:title>
                {{ __('Add gig') }}
            </x-slot:title>

            {{-- {{ print_r($invitedUsers) }} --}}

            <div class="grid grid-cols-1 space-y-4">
                <div>
                    <h3 class="text-md font-medium text-gray-700">{{ __('Details') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Enter your gig details below.</p>
                </div>

                <x-input.group label="{{ __('Name') }}" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" placeholder="{{ __('Tour Opening') }}" />
                </x-input.group>

                <x-input.group label="{{ __('Location') }}" :error="$errors->first('editing.location')">
                    <x-input.text wire:model.defer="editing.location" placeholder="{{ __('Royal Albert Hall') }}" />
                </x-input.group>

                <x-input.group label="{{ __('Date') }}" :error="$errors->first('editing.gig_start')">
                    <x-input.text type="date" wire:model.defer="editing.gig_start" />
                </x-input.group>

                <div class="grid grid-cols-2 space-x-4">
                    <x-input.group label=" {{ __('Fee') }}" :error="$errors->first('editing.fee')">
                        <x-input.money wire:model.defer="editing.fee" placeholder="1000" symbol="€" currency="EUR" />
                    </x-input.group>

                    <x-input.group label=" {{ __('Status') }}" :error="$errors->first('editing.status')">
                        <x-input.select wire:model.defer="editing.status">

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
                            <button wire:click="toggleInvitedUser({{ $user->id }})"
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
                <x-button.secondary wire:click="$set('showSlideOver', false)" color="gray">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary type="submit" class="ml-4">{{ __('Save & Send Invites') }}</x-button.primary>
            </x-slot:footer>
        </x-modal.slideover>
    </form>

</div>
