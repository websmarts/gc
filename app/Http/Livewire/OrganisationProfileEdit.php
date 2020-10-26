<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organisation;

class OrganisationProfileEdit extends Component
{
    
    public $organisation;

    protected $rules = [
        'organisation.name' =>'required',
        'organisation.address.address1' => 'required',
    ];
    

    public function mount()
    {
        $uuid = selected_organisation();

        $this->organisation = Organisation::with('address')->where('uuid','=' ,$uuid)->first();

    }

    public function save()
    {
        dd('save the organisation, and the address');
        // $this->organisation->save();

    }
    
    public function render()
    {
        return view('livewire.organisation-profile-edit');
    }
}
