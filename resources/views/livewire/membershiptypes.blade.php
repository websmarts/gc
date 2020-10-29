<div>



    <div class="p-2 text-right">
        <x-button.primary wire:click="add"><x-icon.plus />Membership option</x-button.secondary>
    </div>
    <x-table>
        <x-slot name="head">
            <x-table.heading class="text-left">Name</x-table.heading>
            <x-table.heading class="text-left">Description</x-table.heading>
            <x-table.heading class="text-left  w-2/12">Max number of members</x-table.heading>
            <x-table.heading class="text-left w-1/12">Fee($)</x-table.heading>
            <x-table.heading class="w-1/12" />
        </x-slot>
        <x-slot name="body">
            @forelse($membershiptypes as $mt)
            <x-table.row>
                <x-table.cell>{{ $mt->name }}</x-table.cell>
                <x-table.cell>{{ $mt->description }}</x-table.cell>
                <x-table.cell>{{ $mt->max_people }}</x-table.cell>
                <x-table.cell>{{ number_format($mt->membership_fee_as_dollars,2) }}</x-table.cell>
                <x-table.cell wire:click="show({{$mt->id}})"><x-button.link>edit</x-button.link></x-table.cell>

            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="4">Nothing to show</x-table.cell>
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
                    <x-input.error for="name" />
                </x-input.group>

                <x-input.group for="description" label="Description">
                    <x-input.text id="description" wire:model.defer='editing.description'></x-input.text>
                    <x-input.error for="description" />
                </x-input.group>

                <x-input.group for="membership_fee" label="Membership fee">
                    <x-input.money id="membership_fee" wire:model.defer='editing.membership_fee_as_dollars'></x-input.money>
                    <x-input.error for="membership_fee_as_dollars" />
                </x-input.group>

                <x-input.group for="max_people" label="Max number of people">
                    <x-input.text id="max_people" wire:model.defer='editing.max_people'></x-input.text>
                    <x-input.error for="max_people" />
                </x-input.group>

             


            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>

        </x-modal.dialog>
    </form>

</div>