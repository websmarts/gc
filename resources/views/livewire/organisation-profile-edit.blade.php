<div>
    <div class="w-7/12">
        <form wire:submit.prevent="save">
            <x-input.group for="name" label="Organisation name">
                <x-input.text id="name" wire:model='organisation.name'></x-input.text>
            </x-input.group>

            <x-input.group for="address1" label="Address 1">
                <x-input.text id="address1"  wire:model='organisation.address.address1'></x-input.text>
            </x-input.group>

            <x-button.primary type="submit">Save</x-button.primary>
        </form>
    </div>
</div>