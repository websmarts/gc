<div>

    <x-table>
        <x-slot name="head">
            <x-table.heading class="text-left">Membership</x-table.heading>
            <x-table.heading class="text-left">Membership Type<br>* <span class="lowercase" >primary contact</span></x-table.heading>
            <x-table.heading class="text-left">Email</x-table.heading>
            <x-table.heading class="text-left">Phone</x-table-heading>
                
        </x-slot>

        <x-slot name="body">

            @forelse($memberships as $membership)

            @forelse($membership->members as $member)
            <x-table.row>
                <x-table.cell>
                    @if($loop->first)<x-button.link wire:click="editMembership({{ $membership->id }})">{{ $membership->name }}</x-button.link>@endif</x-table.cell>
                <x-table.cell>{{ $loop->iteration }}: <x-button.link  wire:click="editContact('{{ $member->uuid }}')">{{ $member->name }}</x-button.link>{{ $member->pivot->is_primary_contact ? '*':'' }}</x-table.cell>
                <x-table.cell>{{ $member->email }}</x-table.cell>
                <x-table.cell>{{ $member->phone }}</x-table.cell>
                

            </x-table.row>
            @empty

            @endforelse



            @empty
            <x-table.row>
                <x-table.cell colspan="4">No memberships found</x-table.cell>
            </x-table.row>
            @endforelse

        </x-slot>
    </x-table>

    <!-- editContactModal -->
    <form wire:submit.prevent="saveContact">
        <x-modal.dialog wire:model.defer="showEditContactModal">
            <x-slot name="title">Edit contact</x-slot>

            <x-slot name="content">

                <x-input.group for="name" label="Name">
                    <x-input.text id="name" wire:model.defer='editingContact.name'></x-input.text>
                    <x-input.error for="name" />
                </x-input.group>

                <x-input.group for="email" label="Email">
                    <x-input.text id="email" wire:model.defer='editingContact.email'></x-input.text>
                    <x-input.error for="email" />
                </x-input.group>

                <x-input.group for="phone" label="Phone">
                    <x-input.text id="phone" wire:model.defer='editingContact.phone'></x-input.text>
                    <x-input.error for="phone" />
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditContactModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

        <!-- editMembershiptModal -->
        <form wire:submit.prevent="saveMembership">
        <x-modal.dialog wire:model="showEditMembershipModal">
            <x-slot name="title">Edit Membership</x-slot>

            <x-slot name="content">

                <x-input.group for="name" label="Name">
                    <x-input.text id="name" wire:model.defer='editingMembership.name'></x-input.text>
                    <x-input.error for="name" />
                </x-input.group>

                <x-input.group for="membership_type_id" label="Membership type">
                    <x-input.select id="membership_type_id" wire:model.defer='editingMembership.membership_type_id'>
                        @foreach($membershipTypes as $mt)
                        <option value="{{ $mt->id }}">{{ $mt->name }}</option>
                        @endforeach

                    </x-input.select>
                    <x-input.error for="membership_type_id" />
                </x-input.group>

                <x-input.group for="primary_contact_id" label="Primary contact">
                    <x-input.select id="primary_contact_id" wire:model.defer='primary_contact_id'>
                        @foreach($editingMembershipMembers as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach

                    </x-input.select>
                    <x-input.error for="primary_contact_id" />
                </x-input.group>

                <x-input.group for="status" label="Status">
                    <x-input.text id="status" wire:model.defer='editingMembership.status'></x-input.text>
                    <x-input.error for="status" />
                </x-input.group>

                

                <x-input.group for="start_date" label="Start date">
                    <x-input.text id="start_date" wire:model.defer='editingMembership.start_date'></x-input.text>
                    <x-input.error for="start_date" />
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditMembershipModal', false)">Cancel</x-button.secondary>
                <x-button.primary wire:click="saveMembership" type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>