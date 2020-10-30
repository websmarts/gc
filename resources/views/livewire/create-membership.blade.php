<div class="sm:w-7/12">

   <div class="p-4 border rounded shadow">

      <div class="mt-4 border-top py-2 font-bold">Membership</div>

      <x-input.group for="membership_type_id" label="Membership option ">
         <x-input.select id="membership_type_id" wire:model="membership.membership_type_id">
            @foreach($membershipTypes as $mt)
            <option value="{{ $mt->id }}">{{ $mt->name }}</option>
            @endforeach
         </x-input.select>
         <x-input.error for="membership.membership_type_id" />
      </x-input.group>

      <x-input.group for="name" label="Membership for <br />(eg The Smith Family, Joe Black )">
         <x-input.text id="name" placeholder="Membership for" wire:model.defer='membership.name'></x-input.text>
         <x-input.error for="membership.name" />
      </x-input.group>

      <x-input.group for="status" label="Status">
         <x-input.select id="status" wire:model.defer='membership.status'>
            <option {{ empty($membership->status) ? 'selected' :'' }}value="">Select status option ... </option>
            @foreach (App\Models\Membership::STATUSES as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
         </x-input.select>
         <x-input.error for="membership.status" />
      </x-input.group>

      <!-- Primary Contact Details -->
      <div class="mt-4 border-top py-2 font-bold">Primary contact details for membership</div>

      <x-input.group for="contact_name" label="Primary contact name">
         <x-input.text wire:model="contact.name" id="contact_name" placeholder="Contact name"></x-input.text>
         <x-input.error for="contact.name" />
      </x-input.group>

      <x-input.group for="contact_email" label="Primary contact email address">
         <x-input.text wire:model="contact.email" id="contact_email" placeholder="Email address"></x-input.text>
         <x-input.error for="contact.email" />
      </x-input.group>

      <x-input.group for="contact_phone" label="Primary contact phone">
         <x-input.text wire:model="contact.phone" id="contact_phone" placeholder="Phone number"></x-input.text>
         <x-input.error for="contact.phone" />
      </x-input.group>


      <div class="text-right">
         <x-button.primary wire:click="createMembership">Save</x-button.primary>
      </div>

   </div>



</div><!-- End Component -->