@props([
'lastItem' => false,
'icon' => 'icon.outline.ticket',
'color' => 'bg-gray-400',
])

<x-timeline-activity :lastItem="$lastItem" :color="$color" :icon="$icon">

    {{ __('There\'s not much happening here...') }}

</x-timeline-activity>
