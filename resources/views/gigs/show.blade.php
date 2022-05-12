<x-app-layout>
    <x-slot:header>
        <x-page-header.simple>
            <x-slot:title>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $gig->name }}
                    <x-badge.sm class="ml-2 align-middle" color="{{ App\Models\Gig::STATUS_COLOR[$gig->status] }}">
                        {{ App\Models\Gig::STATUS[$gig->status] }}</x-badge.sm>
                </h2>
            </x-slot:title>

            <x-slot:subtitle>

                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.location-marker class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ $gig->location }}
                </div>

                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.calendar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ $gig->gig_start->toFormattedDateString() }}
                </div>

                @if ($gig->fee)
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <x-icon.outline.currency-dollar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                    {{ number_format($gig->fee, 0, ',', '.') }}
                </div>
                @endif

            </x-slot:subtitle>
            <x-slot:action>
                <div class="flex space-x-4">
                    <x-button.secondary-leading-icon onclick="window.livewire.emit('openEditGigSlideOver')"
                                                     icon="icon.solid.pencil"
                                                     color="blue">{{ __('Edit Gig') }}
                    </x-button.secondary-leading-icon>

                    @if (auth()->user()->gigResponseForGig($gig->id))
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">

                            @if(auth()->user()->gigResponseForGig($gig->id)->status === 1)
                            <x-button.primary-leading-icon icon="icon.solid.check"
                                                           color="green">{{ __('Accepted') }}
                            </x-button.primary-leading-icon>
                            @elseif(auth()->user()->gigResponseForGig($gig->id)->status === 2)
                            <x-button.primary-leading-icon icon="icon.solid.x"
                                                           color="red">{{ __('Declined') }}
                            </x-button.primary-leading-icon>
                            @elseif (auth()->user()->gigResponseForGig($gig->id)->status === 3)
                            <x-button.primary-leading-icon icon="icon.solid.check"
                                                           color="yellow">{{ __('Tentative') }}
                            </x-button.primary-leading-icon>
                            @else
                            <x-button.primary-leading-icon icon="icon.outline.question-mark-circle"
                                                           color="gray">{{ __('Pending') }}
                            </x-button.primary-leading-icon>
                            @endif

                        </x-slot>
                        <x-slot name="content">
                            <div class="py-1">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Participation') }}
                                </div>

                                @foreach (App\Models\GigResponse::STATUS as $status)
                                <x-switchable-gigresponse-status :status="$status"
                                                                 :gigResponse="auth()->user()->gigResponseForGig($gig->id)" />
                                @endforeach

                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                    @endif

                </div>

            </x-slot:action>
        </x-page-header.simple>
    </x-slot:header>

    <div class="grid grid-cols-1 gap-6 lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-3">
            <!-- Line Up -->
            <x-card label="line-up-title">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">{{ __('Line Up') }}</h2>

                    <div class="mt-6 grid grid-cols-4 lg:grid-cols-6 gap-4 md:py-3">
                        @foreach ($gig->gigResponses as $gigResponse)
                        <div class="flex flex-col items-center">
                            <span class="inline-block relative">
                                <img @class(['h-12 w-12 md:h-14 md:w-14 rounded-full', 'opacity-50'=>
                                $gigResponse->status === 2])
                                src="{{ $gigResponse->user->profile_photo_url }}"
                                alt="{{ $gigResponse->user->name }}">
                                <span @class([ 'absolute top-0 right-0 block h-4 w-4 rounded-full ring-2 ring-white'
                                      , 'bg-gray-300'=> $gigResponse->status === 0, 'bg-green-600' =>
                                    $gigResponse->status === 1, 'bg-red-600' => $gigResponse->status === 2,
                                    'bg-yellow-500' => $gigResponse->status === 3 ])>

                                    @if ($gigResponse->status === 0)
                                    @endif
                                    @if ($gigResponse->status === 1)
                                    <x-icon.solid.check class="h-4 w-4 text-white" />
                                    @endif
                                    @if ($gigResponse->status === 2)
                                    <x-icon.solid.x class="h-4 w-4 text-white" />
                                    @endif
                                    @if ($gigResponse->status === 3)
                                    <x-icon.solid.check class="h-4 w-4 text-white" />
                                    @endif

                                </span>
                            </span>
                            <div class="hidden sm:flex mt-2">
                                <p @class(['text-sm font-medium text-center text-gray-700
                                   group-hover:text-gray-900', 'text-gray-400'=>
                                    $gigResponse->status === 2])>
                                    {{ $gigResponse->user->name }}</p>
                                {{-- <p class="text-xs font-medium text-center text-gray-500 group-hover:text-gray-700">
                                        tbd
                                    </p> --}}
                            </div>
                        </div>
                        @endforeach

                        <!-- Empty State -->
                        {{-- <div class="flex flex-col items-center">
                            <span class="inline-block relative">
                                <div
                                     class="h-12 w-12 md:h-14 md:w-14 rounded-full border-2 border-gray-300
                                     text-gray-300 border-dashed flex-shrink-0 flex items-center justify-center hover:border-gray-400 hover:text-gray-400">
                                    <x-icon.solid.plus class="h-8 w-8" />
                                </div>
                            </span>
                            <div class="hidden sm:flex mt-2">
                                <p class="text-sm font-medium text-center text-gray-700 group-hover:text-gray-900">
                                    {{ __('Invite') }}</p>
                    </div> --}}
                </div>
        </div>

    </div>
    </x-card>
    </div>

    @livewire('gigs-edit', ['gig' => $gig])

</x-app-layout>
