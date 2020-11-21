<div>
    <div>GROUP MEMBERS</div>
    <div class="bg-pink-200">

        <div class="bg-teal-200">Group Selector</div>
        <div class="bg-gray-200 flex items-center justify-between px-4 py-1">

            <div class="">Per Page:
                <select wire:model="perPage" class="text-lg max-w-xs bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                </select>
            </div>
            <div class="p-2">
                <div class="bg-white flex items-center rounded-full shadow-xl">
                    <input 
                    wire:model.debounce="search" 
                    type="text" placeholder="Search members..."
                    class="px-2 rounded-l-full w-full text-gray-700 leading-tight focus:outline-none" 
                    type="text" 
                    placeholder="Search">

                    <div class="">
                        <button class="bg-gray-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <div class="row">
        <table class="shadow-lg bg-white w-full">
            <thead>
                <tr>
                    <th class="bg-blue-100 text-left px-8 py-4"><a wire:click.prevent="sortBy('name')" role="button" href="#">
                            Name
                            @include('includes._sort-icon', ['field' => 'name'])
                        </a></th>
                    <th class="bg-blue-100 text-left px-8 py-4"><a wire:click.prevent="sortBy('email')" role="button" href="#">
                            Email
                            @include('includes._sort-icon', ['field' => 'email'])
                        </a></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                    <td class="border px-8 py-4">{{ $member->name }}</td>
                    <td class="border px-8 py-4">{{ $member->email }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col">
            {{ $members->links() }}
        </div>

        <div class="col text-right text-muted">
            Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} out of {{ $members->total() }} results
        </div>
    </div>
</div>
</div>