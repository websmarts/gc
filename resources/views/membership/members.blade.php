<x-guest-layout>

    <x-slot name="pagetitle">Membership members</x-slot>

    <livewire:membership-members :membershipId="$membership->id" />

</x-guest-layout>