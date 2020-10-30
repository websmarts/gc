<div>
      <!-- List Members Table -->
      <div class="p-4 border rounded shadow">
      <div class="text-right">
         <x-button.link wire:click="$set('showModal', true)">
            <x-icon.plus />Add Member</x-button.link>
      </div>
      <div class="mt-4 border-top py-2 font-bold">Membership members</div>
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
                  <x-button.link class="hover:underline" wire:click="edit({{ $membership->id }})">{{ $membership->name }}{{ $member->pivot->is_primary_contact ? '*' : '' }}</x-button.link>
               </x-table.cell>
               <x-table.cell>{{ $member->email}}}}</x-table.cell>
               <x-table.cell>{{ $member->phone }}</x-table.cell>

               <x-table.cell>edit</x-table.cell>

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
   <x-modal.dialog wire:model="showModal">
      <x-slot name="title">Add/Edit Member form</x-slot>
      <x-slot name="content">

      </x-slot>
      <x-slot name="footer">
         <x-button.secondary wire:click="$set('showModal', false)">Cancel</x-button.secondary>
         <x-button.primary>Save</x-button.primary>
      </x-slot>
   </x-modal.dialog>
</div>