<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrganisationSettings extends Component
{
    public $organisation;
    public $settings =[];

    public function mount()
    {
        $this->organisation = selectedOrganisation();
        $settings = $this->organisation->settings;
        foreach($this->organisation->settings()->allowedKeys() as $key){
            if(!isSet($settings[$key])){
                $settings[$key]='';
            }
        }
        $this->settings = $settings;
    }

    public function save()
    {
        
            selectedOrganisation()->settings()->merge($this->settings);
        
    }
    
    public function render()
    {
        

        
        return view('livewire.organisation-settings');
    }
}
