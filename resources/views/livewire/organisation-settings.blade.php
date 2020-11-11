<div>


    <div class="p-4 border rounded shadow">

<div class="text-right px-4 py-4"><x-button.primary wire:click="save">Update settings</x-button.primary></div>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="text-left">Setting<br /></x-table.heading>
                <x-table.heading class="text-left">Value</x-table.heading>

                <x-table.heading />

            </x-slot>

            <x-slot name="body">

                @forelse($organisation->settings()->allowedKeys() as $key)
               
                <x-table.row>
                    <x-table.cell>
                        {{ $key }}
                    </x-table.cell>
                    <x-table.cell>{{$settings[$key]}}</x-table.cell>
                    <x-table.cell><x-input.text wire:model.defer="settings.{{$key}}" /></x-table.cell>

                </x-table.row>
                

                @empty
                <x-table.row>
                    <x-table.cell colspan="3">No members found</x-table.cell>
                </x-table.row>
                @endforelse

            </x-slot>
        </x-table>

    </div>