@props([
'lastItem' => false,
'icon' => null,
'color' => null,
'date' => null,
'changes' => null,
'causer_name' => null,
'status_description' => null,
'gig_name' => null,
])

@php
switch ($changes['attributes']['status']) {
case 1:
$icon = 'icon.solid.check';
$color = 'bg-green-600';
$status_description = __('accepted');
break;
case 2:
$icon = 'icon.solid.x';
$color = 'bg-red-600';
$status_description = __('declined');
break;
case 3:
$icon = 'icon.solid.check';
$color = 'bg-yellow-500';
$status_description = __('tentatively accepted');
break;
}

if (!is_null(App\Models\Gig::find($changes['attributes']['gig_id']))) {
$gig_name = App\Models\Gig::find($changes['attributes']['gig_id'])->name;
}
@endphp

<x-timeline-activity :lastItem="$lastItem" :color="$color" :date="$date" :icon="$icon">

    {{ $causer_name }} has {{ $status_description }}
    <a href="{{ route('gigs.show', ['gig' => $changes['attributes']['id']]) }}"
       class="font-medium text-gray-900">{{ $gig_name }}</a>.

</x-timeline-activity>
