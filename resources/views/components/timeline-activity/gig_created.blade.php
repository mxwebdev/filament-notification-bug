@props([
'lastItem' => false,
'icon' => 'icon.outline.ticket',
'color' => 'bg-gray-400',
'date' => null,
'changes' => null,
'causer_name' => null,
])

<x-timeline-activity :lastItem="$lastItem" :color="$color" :date="$date" :icon="$icon">

    A new gig
    <a href="{{ route('gigs.show', ['gig' => $changes['attributes']['id']]) }}"
       class="font-medium text-gray-900">{{ $changes['attributes']['name'] }}</a>
    has been created by {{ $causer_name }}

</x-timeline-activity>
