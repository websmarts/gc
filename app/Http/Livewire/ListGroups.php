<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ListGroups extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    
    
    
    public function render()
    {
        
        
        $organisations = \App\Models\Organisation::query()
            ->with('managers')
            ->join('organisation_managers','organisation_managers.organisation_id','=','organisations.id')
            ->join('users','users.id','=','organisation_managers.user_id')
            ->select('organisations.uuid as uuid','users.uuid as manager_uuid','organisations.name as name','users.email as email')
            ->where('organisations.name','like','%'.$this->search .'%')
            ->orWhere('users.email', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

            
        return view('livewire.list-groups', [
            'organisations' => $organisations,
        ]);
    }
}
