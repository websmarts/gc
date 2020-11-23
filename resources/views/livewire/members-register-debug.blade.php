<div>

    <div class="flex justify-between mb-2">
        

        <div class="p-2 text-right">
            <a href="{{ route('create.membership') }}">
                <x-icon.plus />Add membership</a>
        </div>


    </div>


    <x-table>
        <x-slot name="head">

            <x-table.heading class="text-left">
                <x-button.link wire:click="orderBy('name')" class="uppercase">Membership name</x-button.link>
            </x-table.heading>
            <x-table.heading class="text-left">Type</x-table.heading>
            <x-table.heading class="text-left">Status</x-table.heading>
            <x-table.heading class="text-left"># Members</x-table.heading>

            <x-table.heading class="text-left">Renewal sent</x-table.heading>
            <x-table.heading class="text-left">Last renewed</x-table.heading>
            <x-table.heading class="text-left">Renewal status</x-table.heading>

            <x-table.heading class="text-left">
                @if(1)
                Select
                <div>
                    <x-input.checkbox wire:model="selectAll" />
                    <div class="normal-case ml-1">all</div>
                </div>
                @endif

            </x-table.heading>
            <x-table.heading />

        </x-slot>

        <x-slot name="body">

            @forelse($this->organisation->memberships as $membership)

            <x-table.row wire:loading.class="opacity-50" wire:key="{{ $loop->index }}">

                <x-table.cell>{{ $membership->name }}
                   
                </x-table.cell>
                <x-table.cell></x-table.cell>
                <x-table.cell>
                   
                   




                </x-table.cell>
                <x-table.cell></x-table.cell>

                <x-table.cell>


                 

                </x-table.cell>
                <x-table.cell>
                   

                </x-table.cell>
                <x-table.cell>

                    


                </x-table.cell>

                <x-table.cell>
                   
                    
                    

                </x-table.cell>

                <x-table.cell class="w/12 text-right">

                    <x-button.link class="hover:underline" >edit</x-button.link>
                </x-table.cell>

            </x-table.row>

            @empty
            <x-table.row>
                <x-table.cell colspan="8">No memberships found</x-table.cell>
            </x-table.row>
            @endforelse

        </x-slot>

    </x-table>

   
</div>