<div>



    <x-input.group for="role_id" label="Position" :error="$errors->first('role_id')">
        <x-input.select id="role_id" wire:model="role_id">
            <option value="0">Select position to add ...</option>
            @foreach($this->roleOptions as $r)
            <option value="{{ $r->id }}">{{ $r->role }}</option>
            @endforeach
        </x-input.select>
    </x-input.group>

    <div class="relative">
        <div class="">
            <label for="search" class="sr-only">Contact</label>

            <div class="mt-1 relative rounded-md shadow-sm">
                <input wire:model.debounce.250ms="search" id="search" name="search" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="Search by domain extension (.org, .net)" />
            </div>
        </div>

        

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
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading class="text-left">Position</x-table.heading>
            <x-table.heading class="text-left">Filled by</x-table.heading>
            <x-table.heading />
        </x-slot>
        <x-slot name="body">
            @forelse($organisation->positions as $position)
            <x-table.row>
                <x-table.cell>{{ $position->role->role }}</x-table.cell>
                <x-table.cell>{{ $position->contact->name }}</x-table.cell>
                <x-table.cell></x-table.cell>
            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="3">No results as yet</x-table.cell>
            </x-table.row>

            @endforelse

        </x-slot>

    </x-table>
</div>