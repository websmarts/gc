
            <x-input.group for="abn" label="Organisation ABN">
                <x-input.text id="abn" wire:model='organisation.abn'></x-input.text>
                <x-input.error for="organisation.abn" />
            </x-input.group>

            <x-input.group for=".name" label="Organisation name">
                <x-input.text id="name" wire:model.defer='organisation.name'></x-input.text>
                <x-input.error for="organisation.name" />

            </x-input.group>



            <x-input.group for="gst_registered" label="Registered for GST">
                <x-input.select id="gst_registered" wire:model.defer='organisation.gst_registered'>
                    <option value="null">Select option ...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-input.select>
                <x-input.error for="organisation.gst_registered" />
            </x-input.group>

            <x-input.group for="phone" label="Contact phone">
                <x-input.text id="phone" wire:model.defer='organisation.phone'></x-input.text>
                <x-input.error for="organisation.phone" />
            </x-input.group>

            <x-input.group for="address1" label="Address 1">
                <x-input.text id="address1" wire:model.defer='address.address1'></x-input.text>
                <x-input.error for="address.address1" />
            </x-input.group>

            <x-input.group for="address2" label="Address 2">
                <x-input.text id="address2" wire:model.defer='address.address2'></x-input.text>
                <x-input.error for="address.address2" />
            </x-input.group>

            <x-input.group for="city" label="City">
                <x-input.text id="city" wire:model.defer='address.city'></x-input.text>
                <x-input.error for="address.city" />
            </x-input.group>

            <x-input.group for="state" label="State">
                <div style="width:18em">
                    <x-input.select id="state" wire:model.defer='address.state_id'>
                        <option value="0">Select State...</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </x-input.select>
                    <x-input.error for="address.state" />
                </div>
            </x-input.group>



            <x-input.group class="w-1/2" for="postcode" label="Postcode">
                <div style="width:6em">
                    <x-input.text id="postcode" wire:model.defer='address.postcode'></x-input.text>
                </div>
                <x-input.error for="address.postcode" />
            </x-input.group>
