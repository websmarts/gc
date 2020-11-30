<div>

    <div class="w-1/2">

        <x-input.group for="role_id" label="Position" :error="$errors->first('role_id')">
            <x-input.select id="role_id" wire:model="role_id">
                <option value="0">Select position to add ...</option>
                @foreach($this->roleOptions as $r)
                <option value="{{ $r->id }}">{{ $r->role }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <div class="relative">

            <x-input.group for="search" label="Position filled by:" :error="$errors->first('search')">
                <div x-data x-show="$wire.role_id < 1" class="text-red-800">Select position first</div>
                <x-input.text   id="search" placeholder="Search for person to fill position ..." wire:model.debounce.250ms='search'></x-input.text>
                


                <!-- Dropdown search -->

                @if($this->contacts && $role_id)
                <div class="absolute mt-2 w-full bg-white rounded-md shadow-lg">
                    <ul>
                        @foreach($this->contacts as $contact)
                        <li>
                            <a href="#" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                    <div class="min-w-0 flex-1 flex items-center">
                                        <div class="min-w-0 flex-1 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                                <div wire:click="addPosition({{$contact->id}})" class="text-sm leading-5 font-medium text-indigo-600 truncate">{{ $contact->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </x-input.group>
        </div>
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading class="text-left">Position</x-table.heading>
            <x-table.heading class="text-left">Filled by</x-table.heading>
            <x-table.heading class="text-left">Updated</x-table.heading>
            <x-table.heading />
        </x-slot>
        <x-slot name="body">
            @forelse($organisation->positions as $position)
            <x-table.row>
                <x-table.cell>{{ $position->role->role }}</x-table.cell>
                <x-table.cell>{{ $position->contact->name }}</x-table.cell>
                <x-table.cell>{{ $position->updated_at->format('d-m-Y') }}</x-table.cell>
                <x-table.cell>
                    <x-button.link wire:click="remove({{$position->id}})">remove</x-button.link>
                </x-table.cell>
            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="4">No results as yet</x-table.cell>
            </x-table.row>
            @endforelse

        </x-slot>

    </x-table>
</div>