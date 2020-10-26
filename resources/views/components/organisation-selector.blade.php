@props([
'organisations'
])
<div class="space-y-4">
    <div class="text-right">
        <x-button class="bg-teal-500 hover:bg-teal-400 text-white">
            <x-icon.plus></x-icon.plus>Register Organisation
        </x-button>
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="w-1/12" ></x-table.heading>
                <x-table.heading class="text-left font-extrabold w-full">Registered Organisations</x-table.heading>
                <x-table.heading ></x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse($organisations as $organisation)
                <x-table.row class="{{ $loop->even ? 'bg-teal-50':'' }}">
                    <x-table.cell><x-input.checkbox class="text-teal-500"></x-input.checkbox></x-table.cell>
                    <x-table.cell>{{ $organisation->name }}</x-table.cell>
                    <x-table.cell><x-button class=" text-gray-700 hover:bg-gray-100">Edit</x-button></x-table.cell>
                </x-table.row>
                @empty

                <x-table.row>
                    <x-table.cell colspan="3">
                        <div class="mb-4">This account currently has no registered organisations.</div>

                        <div>Click here to register one now
                            <x-button class="bg-teal-500 hover:bg-teal-400 text-white">
                                <x-icon.plus></x-icon.plus>Register Organisation
                            </x-button>
                        </div>
                    </x-table.cell>
                    
                </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
    </div>
</div