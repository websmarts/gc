<x-guest-layout>

    <x-slot name="pagetitle">Update details for the {{ $membership->name }} membership</x-slot>

    <p class="p-3">Membership name: {{ $membership->name }} currently has {{  $membership->members->count() }} members linked to it, see details below.</p>
    <p class="p-3">You can update the members details by clicking on their edit link.</p>
    <p class="p-3">Your membership can have up to {{ $membership->membershipType->max_people}} family members linked to it. 
    </p>

    @if($membership->membershipType->max_people >  $membership->members->count())
    <p class="p-3"> To add any new members click on the  Add Member link and fill in the details required.</p>
    @endif

    <livewire:membership-members :membershipId="$membership->id" />

</x-guest-layout>