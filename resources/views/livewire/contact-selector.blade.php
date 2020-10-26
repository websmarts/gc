<div class="space-y-4">
    <div class="text-right">
        <x-button class="bg-teal-500 hover:bg-teal-400 text-white">
            <x-icon.plus></x-icon.plus>Add contact
        </x-button>
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                
                <x-table.heading class="text-left font-extrabold ">Name</x-table.heading>
                <x-table.heading class="text-left font-extrabold ">Email</x-table.heading>
                <x-table.heading class="text-left font-extrabold ">Phone</x-table.heading>
                <x-table.heading class="w-1/4 text-left font-extrabold">Address</x-table.heading>

                <x-table.heading ></x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse($contacts as $contact)
                <x-table.row class="{{ $loop->even ? 'bg-teal-50':'' }}">
                    
                    <x-table.cell>{{ $contact->name }}</x-table.cell>
                    <x-table.cell>{{ $contact->email }}</x-table.cell>
                    <x-table.cell>{{ $contact->phone }}</x-table.cell>
                    <x-table.cell>{{ $contact->address->fullAddress }}</x-table.cell>
                    <x-table.cell ><x-button class="text-gray-700 hover:bg-gray-100">Edit</x-button></x-table.cell>
                </x-table.row>
                @empty

                <x-table.row>
                    <x-table.cell colspan="5">
                        <div class="mb-4">The organisation currently has no contacts listed.</div>

                    </x-table.cell>
                    
                </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
    </div>
</div
