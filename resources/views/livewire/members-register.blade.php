<div>

    <div class="flex justify-between mb-2">
        <div class="w-1/4">
            <x-input.text placeholder="Search memberships ..." wire:model.debounce.300ms="search" />
        </div>


        <div x-data x-show="$wire.showRenewButton">
            <div wire:loading.remove>
                <x-button.primary wire:click.prevent=" sendRenewals()">Send ({{ $this->renewalCount }}) Membership Renewal Emails</x-button.primary>
            </div>
        </div>

        <div class="p-2 text-right">
            <x-link.text to="{{ route('create.membership') }}">
                <x-icon.plus />Add membership</x-link.text>
        </div>


    </div>


    <x-table>
        <x-slot name="head">
            <x-table.heading />
            <x-table.heading class="text-left">
                <x-button.link wire:click="orderBy('name')" class="uppercase">Membership name</x-button.link>
            </x-table.heading>
            <x-table.heading class="text-left">Type</x-table.heading>
            <x-table.heading class="text-left">Status</x-table.heading>
            <x-table.heading class="text-left"># Members</x-table.heading>

            <x-table.heading class="text-left">Renewal sent</x-table.heading>
            <x-table.heading class="text-left">Last renewed</x-table.heading>
            <x-table.heading class="text-left">Renewal status</x-table.heading>

            <x-table.heading class="text-left">
                @if($this->organisation->hasRenewableMemberships())
                Select
                <div>
                    <x-input.checkbox wire:model="selectAll" />
                    <div class="normal-case ml-1">all</div>
                </div>
                @endif

            </x-table.heading>


        </x-slot>

        <x-slot name="body">

            @forelse($this->organisation->memberships as $membership)

            <x-table.row wire:loading.class="opacity-50" wire:key="{{ $loop->index }}">
                <x-table.cell class="w/12 text-right">
                    <x-button.link class="underline hover:no-underline" wire:click="edit({{ $membership->id }})">edit</x-button.link>
                </x-table.cell>

                <x-table.cell>{{ $membership->name }}
                    @if($membership->primaryContact() && !$membership->primaryContact()->verifiedEmailAddress())
                    <p class="text-red-700">Primary contact email has not been verified yet</p>
                    @endif
                    @if(!$membership->primaryContact())
                    <p class="text-red-700">Primary contact not set</p>
                    @endif
                </x-table.cell>
                <x-table.cell>{{ $membership->membershipType->name }}</x-table.cell>
                <x-table.cell>
                    {{ App\Models\Membership::STATUSES[$membership->status] }}





                </x-table.cell>
                <x-table.cell>{{ $membership->members->count() }} &nbsp;<x-link.text to="{{ route('membership.members',['membership'=> $membership->id])}}">
                        edit</x-link.text>
                </x-table.cell>

                <x-table.cell>


                    @if($membership->latestRenewalIssuedDate)
                    {{ $membership->latestRenewalIssuedDate->tz('Australia/Melbourne')->format('d-m-Y') }}
                    @endif

                </x-table.cell>
                <x-table.cell>
                    @if($membership->latestRenewalPaymentDate )
                    {{ $membership->latestRenewalPaymentDate->tz('Australia/Melbourne')->format('d-m-Y') }}
                    @endif
                    @if($membership->last_payment_method)
                        {{ $membership->last_payment_method }}
                    @endif

                </x-table.cell>
                <x-table.cell>

                    @if(!$membership->latestRenewalPaymentDate)
                    {{ $membership->membershipType->daysIntoSubscription() }} days late

                    @elseif( $membership->isCurrentlyFinancial() )
                    Current
                    @endif


                </x-table.cell>

                <x-table.cell>
                    @if($membership->isRenewable())
                    <x-input.checkbox wire:model="selected.{{ $membership->id }}" />
                    @endif

                </x-table.cell>



            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="8">No memberships found</x-table.cell>
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
                        @foreach($this->organisation->membershipTypes as $mt)
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
                <x-input.group for="note" label="Membership note" :error="$errors->first('editing.note')">
                    <x-input.text id="note" wire:model='editing.note'></x-input.text>
                </x-input.group>

                <p>Add a renewal payment</p>
                <x-input.group for="gross_amount_paid" label="Amount paid" :error="$errors->first('transaction.gross_amount_paid')">
                    <x-input.text id="gross_amount_paid" wire:model='transaction.gross_amount_paid'></x-input.text>
                </x-input.group>


                <x-input.group for="note" label="Payment note" :error="$errors->first('transaction.note')">
                    <x-input.text id="note" wire:model='transaction.note'></x-input.text>
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