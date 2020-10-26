<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Organisation;

class OrganisationProfileEdit extends Component
{
    public  $organisation;
    public  $address;
    public  $states;

    protected $rules = [
        'organisation.name' => 'required',
        'organisation.abn' => 'required',
        'organisation.gst_registered' => 'required',
        'address.address1' => 'required',
        'address.address2' => 'nullable',
        'address.city' => 'required',
        'address.postcode' => 'required',
        'address.state_id' => 'required',

    ];
    public function mount()
    {
        $this->organisation = Organisation::where('uuid',auth()->user()->last_selected_organisation_uuid)->get()->first();
        
        $this->address = $this->organisation->address;
        
        $this->states = State::get();
    }

    public function save()
    {
        $data = $this->validate();

        $this->address->update($data['address']);

        $this->organisation->update($data['organisation']);

        session()->flash('message','Organisation details updated');

        return redirect('/dashboard');
    }
    
    public function render()
    {
        return view('livewire.organisation-profile-edit');
    }
}
