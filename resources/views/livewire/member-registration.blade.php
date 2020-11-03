<div class="sm:w-7/12">

    <div class="p-4 border rounded shadow">

        <div class="mt-4 border-top py-2 font-bold">Member Registration</div>
        <form wire:submit.prevent="create">
            <x-input.group for="membership_type_id" label="Membership option ">
                <x-input.select id="membership_type_id" wire:model="membership_type_id">
                    <option  value="0">Select membership option ...</option>
                    @foreach($membershipTypes as $mt)
                    <option value="{{ $mt->id }}">{{ $mt->name }} (${{$mt->membership_fee_as_dollars}} / year)</option>
                    @endforeach
                </x-input.select>
                <x-input.error for="membership_type_id" />
                <p class="px-4 text-sm font-italic">The group offers several membership options. Please select the most appropriate option for your situation. </p>
            </x-input.group>

            <x-input.group for="name" label="Membership for <br />(eg The Smith Family, Joe Black )">
                <x-input.text id="name" placeholder="Membership for" wire:model.defer='membership_name'></x-input.text>
                <x-input.error for="membership_name" />
                <p class="px-4 text-sm font-italic"> Enter a name that best describes your membership. For example if you are registering as an individual then just enter your name here, or if you are registering as a family then a better option would be to enter something like "The Smith Family"</p>
            </x-input.group>



            <!-- Primary Contact Details -->
            <div class="mt-4 border-top py-2 font-bold">Primary contact details for membership</div>
            <p class="px-4 pb-2 text-sm font-italic">The primary contact is the person who will receive all official notifications from the group regarding the membership. </p>

            <x-input.group for="contact_name" label="Primary contact name" :error="$errors->first('contact_name')">
                <x-input.text wire:model="contact_name" id="contact_name" placeholder="Contact name"></x-input.text>
            </x-input.group>

            <x-input.group for="contact_email" label="Primary contact email address" :error="$errors->first('contact_email')">
                <x-input.text wire:model="contact_email" id="contact_email" placeholder="Email address"></x-input.text>
            </x-input.group>

            <x-input.group for="contact_phone" label="Primary contact phone" :error="$errors->first('contact_phone')">
                <x-input.text wire:model="contact_phone" id="contact_phone" placeholder="Phone number"></x-input.text>
            </x-input.group>


            <div class="text-right">
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </form>


    </div>

</div><!-- End Component -->