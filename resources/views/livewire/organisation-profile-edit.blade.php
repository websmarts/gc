<div>
    <div class="w-7/12">
        <form wire:submit.prevent="save">

            @include('livewire.forms.organisation-profile')

            <div class="flex justify-end">
                <x-button.primary class="mt-4 sm:mt-1" type="submit">Save</x-button.primary>
            </div>
        </form>
    </div>
</div>