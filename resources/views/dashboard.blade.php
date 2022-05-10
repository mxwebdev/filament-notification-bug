<x-app-layout>
    <x-slot name="header">
        {{ auth()->user()->currentTeam->name }}
    </x-slot>

    @livewire('gig-calendar')
</x-app-layout>
