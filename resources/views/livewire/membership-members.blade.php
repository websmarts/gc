<div>
    <!-- List Members Table -->
    <div class="p-4 border rounded shadow">
        <div class="text-right">
            @if($membership->membershipType->max_people > $membership->members->count())
                <x-button.link wire:click.prevent="create">
                    <x-icon.plus />Add Member</x-button.link>
                @else
                Membership member limit reached
                @endif
        </div>
        <div class="mt-4 border-top py-2 font-bold">{{ $membership->name }}
            <br /><span class="font-normal text-cool-gray600">member limit = {{ $this->membership->membershipType->max_people }}</span>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="text-left">Member<br /><span class="lowercase text-sm">* primary contact</span></x-table.heading>
                <x-table.heading class="text-left">Email</x-table.heading>
                <x-table.heading class="text-left">Phone</x-table.heading>

                <x-table.heading class="text-left">
                    </x-table-heading>

            </x-slot>

            <x-slot name="body">

                @forelse($membership->members as $member)
                <x-table.row>
                    <x-table.cell>
                        <x-button.link class="hover:underline" wire:click.prevent="edit('{{ $member->uuid }}')">{{ $member->name }}{{ $member->pivot->is_primary_contact ? '*' : '' }}</x-button.link>
                    </x-table.cell>
                    <x-table.cell>{{ $member->email}}</x-table.cell>
                    <x-table.cell>{{ $member->phone }}</x-table.cell>

                    <x-table.cell>
                        <x-button.link wire:click.prevent="edit('{{ $member->uuid }}')">edit</x-button.link>
                    </x-table.cell>

                </x-table.row>

                @empty
                <x-table.row>
                    <x-table.cell colspan="5">No members found</x-table.cell>
                </x-table.row>
                @endforelse

            </x-slot>
        </x-table>


    </div>

    <!-- Add/Edit Members Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">Add/Edit Member form</x-slot>
            <x-slot name="content">

                <x-input.group for="name" label="Name">
                    <x-input.text wire:model="editing.name" id="contact_name" placeholder="Name"></x-input.text>
                    <x-input.error for="editing.name" />
                </x-input.group>

                <x-input.group for="email" label="Email">
                    <x-input.text wire:model="editing.email" id="email" placeholder="Email"></x-input.text>
                    <x-input.error for="editing.email" />
                </x-input.group>

                <x-input.group for="phone" label="Phone">
                    <x-input.text wire:model="editing.phone" id="phone" placeholder="Phone"></x-input.text>
                    <x-input.error for="editing.phone" />
                </x-input.group>

                <x-input.group for="is_primary_contact" label="Primary contact">
                    <x-input.select wire:model="is_primary_contact" id="is_primary_contact" >
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </x-input.select>
                    <x-input.error for="is_primary_contact" />
                </x-input.group>

                <!-- Address inputs -->
                <x-input.group for="address1" label="Address 1">
                    <x-input.text wire:model="address.address1" id="address1" placeholder="Address 1"></x-input.text>
                    <x-input.error for="address.address1" />
                </x-input.group>

                <x-input.group for="address2" label="Address 2">
                    <x-input.text wire:model="address.address2" id="address2" placeholder="Address 2"></x-input.text>
                    <x-input.error for="address.address2" />
                </x-input.group>

                <x-input.group for="city" label="City">
                    <x-input.text wire:model="address.city" id="city" placeholder="City"></x-input.text>
                    <x-input.error for="address.city" />
                </x-input.group>

                <x-input.group for="state" label="State">
                <div style="width:18em">
                    <x-input.select id="state" wire:model.defer='address.state_id'>
                        <option value="">Select State...</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </x-input.select>
                    <x-input.error for="address.state_id" />
                </div>
            </x-input.group>

                <x-input.group for="postcode" label="Postcode">
                    <x-input.text wire:model="address.postcode" id="postcode" placeholder="Postcode"></x-input.text>
                    <x-input.error for="address.postcode" />
                </x-input.group>

            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-between">

                    <x-button.danger wire:click="$set('showConfirmDeleteMemberModal', true)">Delete</x-button.danger>
                    <div>
                        <x-button.secondary wire:click="$set('showModal', false)">Cancel</x-button.secondary>
                        <x-button.primary type="submit">Save</x-button.primary>
                    </div>
                </div>
            </x-slot>
        </x-modal.dialog>
    </form>
    <x-modal.confirmation  wire:model="showConfirmDeleteMemberModal">
        <x-slot name="title">Confirm Delete Member</x-slot>
        <x-slot name="content">
            <p>This action cannot be un-done</p>
            <p>Click the Delete Member button to confirm you really want to remove this member</p>
    
        </x-slot>
        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showConfirmDeleteMemberModal', false)">Cancel</x-button.secondary>
            <x-button.primary wire:click="deleteMember">Delete Member</x-button.primary>
        </x-slot>
    </x-modal.confirmation>
</div>