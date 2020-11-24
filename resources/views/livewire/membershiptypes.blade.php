<div>



    <div class="p-2 text-right">
        <x-button.link wire:click="add">
            <x-icon.plus />Membership option</x-button.link>
    </div>
    <x-table>
        <x-slot name="head">
            <x-table.heading class="text-left">Name</x-table.heading>
            <x-table.heading class="text-left">Description</x-table.heading>
            <x-table.heading class="text-left">Max number of members</x-table.heading>
            <x-table.heading class="text-left">Renewal month</x-table.heading>
            <x-table.heading class="text-left">Fee($)</x-table.heading>
            <x-table.heading class="w-1/12" />
        </x-slot>
        <x-slot name="body">
            @forelse($membershiptypes as $mt)
            <x-table.row>
                <x-table.cell>{{ $mt->name }}</x-table.cell>
                <x-table.cell>{{ $mt->description }}</x-table.cell>
                <x-table.cell>{{ $mt->max_people }}</x-table.cell>
                <x-table.cell>{{ $mt->renewal_month ? MONTHS[$mt->renewal_month] : '' }}</x-table.cell>
                <x-table.cell>{{ $mt->membership_fee_as_dollars }}</x-table.cell>
                <x-table.cell wire:click="show({{$mt->id}})">
                    <x-button.link>edit</x-button.link>
                </x-table.cell>

            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="6">Nothing to show</x-table.cell>
            </x-table.row>
            @endforelse
        </x-slot>

    </x-table>

    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">
            <x-slot name="title">Membership Type</x-slot>

            <x-slot name="content">

                <x-input.group for="name" label="Title">
                    <x-input.text id="name" wire:model='editing.name'></x-input.text>
                    <x-input.error for="editing.name" />
                </x-input.group>

                <x-input.group for="description" label="Description">
                    <x-input.text id="description" wire:model.defer='editing.description'></x-input.text>
                    <x-input.error for="editing.description" />
                </x-input.group>

                <x-input.group for="max_people" label="Max number of members">
                    <x-input.text id="max_people" wire:model.defer='editing.max_people'></x-input.text>
                    <x-input.error for="editing.max_people" />
                </x-input.group>

                <x-input.group for="membership_fee" label="Membership fee">
                    <x-input.money id="membership_fee" wire:model.defer='editing.membership_fee_as_dollars'></x-input.money>
                    <x-input.error for="editing.membership_fee_as_dollars" />
                </x-input.group>

                

                <x-input.group for="renewal_month" label="Renewal month">
                    <x-input.select id="renewal_month" wire:model.defer='editing.renewal_month'>
                        <option {{ empty($membership->renewal_month) ? 'selected' :'' }}value="">Select renewal month for this membership type ... </option>
                        @foreach (MONTHS as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                    <x-input.error for="editing.renewal_month" />
                </x-input.group>




            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>

        </x-modal.dialog>
    </form>

</div>