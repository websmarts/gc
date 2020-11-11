<div>
<div class="flex justify-between mb-2">
        <div class="w-1/4">
            <x-input.text placeholder="Search contacts ..." wire:model="search" />
        </div>

        <div class="p-2 text-right">
            <a href="#" wire:click.prevent="create">
                <x-icon.plus />Add non-member contact</a>
        </div>
    </div>

    <x-table>
        <x-slot name="head">

            <x-table.heading class="w-2/12 text-left">Contact<br></x-table.heading>
            <x-table.heading class="text-left">Notes</x-table.heading>
            <x-table.heading />

        </x-slot>

        <x-slot name="body">

            @forelse($contacts as $contact)

            <x-table.row wire:loading.class="opacity-50">

                <x-table.cell class="text-left">
                    {{ $contact->name }}<br />
                    {{ $contact->email }}<br />
                    {{ $contact->phone }}
                </x-table.cell>
                <x-table.cell class="text-left">{{ $contact->notes }}</x-table.cell>
                <x-table.cell class="text-right w-1/12">
                    <x-button.link class="hover:underline" wire:click="edit({{$contact->id}})">edit</x-button.link>
                </x-table.cell>

            </x-table.row>
            @empty 
            <x-table.row>
                <x-table.cell colspan="3">No contacts found</x-table.cell>
            </x-table.row>
            @endforelse

        </x-slot>

    </x-table>


    <!-- Add/Edit Members Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">
            <x-slot name="title">Add/Edit Contact form</x-slot>
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

                <x-input.group for="notes" label="Notes">
                    <x-input.textarea wire:model="editing.notes" id="notes" placeholder="notes"></x-input.textarea>
                    <x-input.error for="editing.notes" />
                </x-input.group>






            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-between">

                    <x-button.danger wire:click="$set('showConfirmDeleteModal', true)">Delete</x-button.danger>
                    <div>
                        <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                        <x-button.primary type="submit">Save</x-button.primary>
                    </div>
                </div>
            </x-slot>
        </x-modal.dialog>
    </form>
    <x-modal.confirmation wire:model="showConfirmDeleteModal">
        <x-slot name="title">Confirm Delete Member</x-slot>
        <x-slot name="content">
            <p>This action cannot be un-done</p>
            <p>Click the Delete Member button to confirm you really want to remove this member</p>

        </x-slot>
        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showConfirmDeleteModal', false)">Cancel</x-button.secondary>
            <x-button.primary wire:click="delete">Delete contact</x-button.primary>
        </x-slot>
    </x-modal.confirmation>
</div>
</div>