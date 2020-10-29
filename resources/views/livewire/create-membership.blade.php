<div>
   <div class="text-3xl">Create Membership </div>

   <x-input.group for="membership_type_id" label="Membership type">
      <x-input.select id="membership_type_id" wire:model="membershipTypeId">
         @foreach($membershipTypes as $mt)
         <option value="{{ $mt->id }}">{{ $mt->name }}</option>
         @endforeach
      </x-input.select>
      <x-input.error for="membershipTypeId" />
   </x-input.group>

   <x-input.group for="name" label="Membership name (eg The Smith Family )">
      <x-input.text id="name" placeholder="Membership name" wire:model.defer='membershipName'></x-input.text>
      <x-input.error for="membershipName" />
   </x-input.group>

</div>