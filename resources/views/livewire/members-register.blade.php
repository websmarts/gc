<div>

    <div class="flex justify-between mb-2">
        <div class="w-1/4">
            <x-input.text placeholder="Search memberships ..." wire:model="search" />
        </div>

        <div class="p-2 text-right">
            <a href="{{ route('create.membership') }}">
                <x-icon.plus />Add membership</a>
        </div>
    </div>

    <x-table>
        <x-slot name="head">

            <x-table.heading class="text-left">Membership name<br></x-table.heading>
            <x-table.heading class="text-left">Type</x-table.heading>
            <x-table.heading class="text-left">Status</x-table.heading>
            <x-table.heading class="text-left"># Members</x-table.heading>
            <x-table.heading class="text-left">Fees due</x-table-heading>

        </x-slot>

        <x-slot name="body">

            @forelse($memberships as $membership)

            <x-table.row wire:loading.class="opacity-50">

                <x-table.cell>
                    <x-button.link class="hover:underline" wire:click="edit({{ $membership->id }})">{{ $membership->name }}</x-button.link>
                </x-table.cell>
                <x-table.cell>{{ $membership->membershipType->name }}</x-table.cell>
                <x-table.cell>{{ App\Models\Membership::STATUSES[$membership->status] }}</x-table.cell>
                <x-table.cell><a href="{{ route('membership.members',['membership'=> $membership->id])}}">{{ $membership->members->count() }}</a></x-table.cell>
                <x-table.cell>{{ optional($membership->fee_due_date)->format('d-m-Y') }}</x-table.cell>

            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="5">No memberships found</x-table.cell>
            </x-table.row>
            @endforelse

        </x-slot>

    </x-table>

    <!-- editMembershiptModal -->
    <form wire:submit.prevent="saveMembership">
        <x-modal.dialog wire:model="showEditMembershipModal">
            <x-slot name="title">Edit Membership</x-slot>

            <x-slot name="content">

                <x-input.group for="name" label="Name" :error="$errors->first('editing.name')">
                    <x-input.text id="name" wire:model.defer='editing.name'></x-input.text>   
                </x-input.group>

                <x-input.group for="membership_type_id" label="Membership type" :error="$errors->first('editing.membership_type_id')">
                    <x-input.select id="membership_type_id" wire:model.defer="editing.membership_type_id">
                        @foreach($membershipTypes as $mt)
                        <option value="{{ $mt->id }}">{{ $mt->name }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>


                <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
                    <x-input.select id="status" wire:model.defer='editing.status'>
                        @foreach (App\Models\Membership::STATUSES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>



                <x-input.group for="start_date" label="Start date" :error="$errors->first('proxy_start_date')">
                    <x-input.text id="start_date" wire:model.defer='proxy_start_date'></x-input.text>
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-between">

                    <x-button.danger wire:click="$set('showConfirmDeleteMembershipModal', true)">Delete</x-button.danger>
                    <div>
                        <x-button.secondary wire:click="$set('showEditMembershipModal', false)">Cancel</x-button.secondary>
                        <x-button.primary type="submit">Save</x-button.primary>
                    </div>
                </div>

            </x-slot>
        </x-modal.dialog>
    </form>

    <x-modal.confirmation wire:model="showConfirmDeleteMembershipModal">
        <x-slot name="title">Confirm Delete Membership</x-slot>
        <x-slot name="content">
            <p>This action cannot be un-done</p>
            <p>Click the Delete Membership button to confirm you really want to delete this membership</p>

        </x-slot>
        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showConfirmDeleteMembershipModal', false)">Cancel</x-button.secondary>
            <x-button.primary wire:click="deleteMembership">Delete Membership</x-button.primary>
        </x-slot>
    </x-modal.confirmation>
</div>