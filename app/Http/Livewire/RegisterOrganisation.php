<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Organisation;

class RegisterOrganisation extends Component
{
    public  $organisation;
    public  $address;
    public  $states;

    protected $rules = [
        'organisation.name' => 'required',
        'organisation.abn' => 'required',
        'organisation.gst_registered' => 'required',
        'organisation.phone'=>'required',
        'address.address1' => 'required',
        'address.address2' => 'nullable',
        'address.city' => 'required',
        'address.postcode' => 'required',
        'address.state_id' => 'required',

    ];
    public function mount()
    {
        $this->organisation = Organisation::make();
        $this->organisation->gst_registered = null;

        $this->address = Address::create();
        $this->address->state_id = null;
        $this->states = State::get();
    }

    public function save()
    {
        $data = $this->validate();
        $address = Address::create($data['address']);

        $data['organisation']['address_id'] = $address->id;
        $data['organisation']['uuid'] = (string) Str::uuid();
        $data['organisation']['slug'] = Str::slug($data['organisation']['name']);
        $organisation = Organisation::create($data['organisation']);

        auth()->user()->organisations()->attach($organisation);

        auth()->user()->last_selected_organisation_uuid = $organisation->uuid;

        session()->flash('message', 'Organisation has been added and is linked to this account');

        return redirect('/dashboard');
        
        
    }

    public function render()
    {
        return view('livewire.organisation-register');
    }
}
