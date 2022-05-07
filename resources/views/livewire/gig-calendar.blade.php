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

            <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">

                @foreach ($selectedDateRange as $date)

                <button wire:click="setSelectedDate('{{ $date->format('Y-m-d') }}')"
                        type="button"
                        @class([
                            'py-1.5 hover:bg-gray-100 focus:z-10',
                            'bg-white' => $date->isSameMonth($selectedDate),
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
                        @class([
                        'mx-auto flex h-7 w-7 items-center justify-center rounded-full',
                        'bg-indigo-600' => $date->isSameDay($selectedDate) and $date->isSameDay(Carbon\Carbon::now()),
                        'bg-gray-900' => $date->isSameDay($selectedDate) and !$date->isSameDay(Carbon\Carbon::now()),
                        ])>{{ $date->format('j') }}</time>
                </button>

                @endforeach

            </div>
            <button type="button"
                    class="focus:outline-none mt-8 w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{ __('Add gig') }}</button>
        </div>

        <ol class="mt-4 divide-y divide-gray-100 text-sm leading-6 lg:col-span-7 xl:col-span-8">
            <li class="relative flex space-x-6 py-6 xl:static">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                     alt="" class="h-14 w-14 flex-none rounded-full">
                <div class="flex-auto">
                    <h3 class="pr-10 font-semibold text-gray-900 xl:pr-0">Leslie Alexander</h3>
                    <dl class="mt-2 flex flex-col text-gray-500 xl:flex-row">
                        <div class="flex items-start space-x-3">
                            <dt class="mt-0.5">
                                <span class="sr-only">Date</span>
                                <!-- Heroicon name: solid/calendar -->
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                          clip-rule="evenodd" />
                                </svg>
                            </dt>
                            <dd><time datetime="2022-01-10T17:00">January 10th, 2022 at 5:00 PM</time></dd>
                        </div>
                        <div
                             class="mt-2 flex items-start space-x-3 xl:mt-0 xl:ml-3.5 xl:border-l xl:border-gray-400 xl:border-opacity-50 xl:pl-3.5">
                            <dt class="mt-0.5">
                                <span class="sr-only">Location</span>
                                <!-- Heroicon name: solid/location-marker -->
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                          clip-rule="evenodd" />
                                </svg>
                            </dt>
                            <dd>Starbucks</dd>
                        </div>
                    </dl>
                </div>
                <div class="absolute top-6 right-0 xl:relative xl:top-auto xl:right-auto xl:self-center">

                    <x-jet-dropdown width="36">
                        <x-slot name="trigger">
                            <button type="button"
                                    class="-m-2 flex items-center rounded-full p-2 text-gray-500 hover:text-gray-600"
                                    id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open options</span>
                                <!-- Heroicon name: solid/dots-horizontal -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path
                                          d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div>
                                <x-jet-dropdown-link href="#">Edit</x-jet-dropdown-link>
                                <x-jet-dropdown-link href="#">Cancel</x-jet-dropdown-link>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </li>
        </ol>
    </div>
</div>
