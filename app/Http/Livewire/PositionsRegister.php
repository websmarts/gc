<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoleOption;
use Illuminate\Support\Str;
use App\Models\OrganisationRole;

class PositionsRegister extends Component
{
    
    public $organisation;
    public $roleOptions =[];
    public $role_id;

    
    public $search;

    protected $rules = [
        'contact'=>'required',
        'role_id'=>'required'
    ];

    public function mount()
    {
        $this->roleOptions = RoleOption::all();

    }

    public function updatedSearch($search)
    {
        
    }

    public function getContactsProperty()
    {
        $search = $this->search;
        if(!empty($search)){
            return $this->organisation->contacts->filter(function($item,$key) use($search){
                if(Str::contains(strtolower($item->name),strtolower($search) ) ) {
                    return $item;
                }
            });
        }
        
    }

    public function addPosition($contactId)
    {
        $data = [
            'contact_id'=>$contactId,
            'role_id'=>$this->role_id,
            'organisation_id' => $this->organisation->id
            ];

            OrganisationRole::create($data);

            $this->role_id = 0;

        // add the organisation_role 
    }
    
    
    public function render()
    {
        $this->organisation = selectedOrganisation();

        return view('livewire.positions-register');
    }
}
