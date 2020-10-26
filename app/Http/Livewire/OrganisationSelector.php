<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use App\Models\Organisation;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;



class OrganisationSelector extends Component
{
    
    public \Illuminate\Support\Collection $organisations;

    public $selectedOrganisation = null;

    public $placeholder = true;

    protected $rules =[
        'selectedOrganisation.uuid' => 'present'
    ];


    public function mount()
    {
        $this->organisations = auth()->user()->organisations;
// session()->has('selected_organisation_uuid')
        if($uuid = auth()->user()->last_selected_organisation_uuid)
        {
            $this->selectedOrganisation = Organisation::where('uuid',$uuid)->get()->first();
            // dd($this->selectedOrganisation);
           // $this->selectedOrganisation = session()->get('selected_organisation_uuid');
            $this->placeholder = false;
        } elseif($this->organisations->count() > 0) {
            // select the first org
            $this->selectedOrganisation = $this->organisations->first()->uuid;
        }

        
    
    }

    public function updatingSelectedOrganisation($uuid)
    {
        $this->selectedOrganisation = $uuid;
        session()->put('selected_organisation_uuid',$uuid);

        auth()->user()->last_selected_organisation_uuid = $uuid;
        auth()->user()->save();
        
        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.organisation-selector');
    }
}
