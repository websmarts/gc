<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MembershipType;

class Membershiptypes extends Component
{
    
    public $membershiptypes;

    public $showEditModal = false;

    public $editing;

    protected $organisation;
    

   
    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.description' => 'required',
            'editing.max_people' => 'required',
            'editing.renewal_month' => 'required',
            'editing.membership_fee_as_dollars' => 'required',
            
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankEditable();
    }

    public function makeBlankEditable()
    {
        return MembershipType::make();
    }

    public function add()
    {
        if($this->editing->getKey()) $this->editing = $this->makeBlankEditable();
        $this->showEditModal = true;
    }

    public function show(MembershipType $membershipType)
    {
       
        if($this->editing->isNot($membershipType) ) $this->editing = $membershipType;
        $this->showEditModal = true;

    }

    public function save()
    {
        $this->validate();
        
        auth()->user()->selectedOrganisation()->membershipTypes()->save($this->editing);

        $this->showEditModal = false;
    }
    
    
    public function render()
    {
        $this->membershiptypes = auth()->user()->selectedOrganisation()->membershipTypes()->get();
        return view('livewire.membershiptypes');
    }
}
