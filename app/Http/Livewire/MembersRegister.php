<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Rules\inputdate;
use App\Models\Membership;
use Illuminate\Support\Carbon;
use App\Events\MembershipDeleted;
use App\Models\Contact as Member;
use App\Models\ContactMembership;




class MembersRegister extends Component
{
    public $memberships;
    public $membershipTypes;

    public $search ='';

    public $editing; // Membership Model
    public $proxy_start_date; // temp holder for editing.start_date



    public $showEditMembershipModal = false;
    public $showConfirmDeleteMembershipModal = false;

   

    public function rules()
    {
        return $rules =  [
            'editing.name'=>'required',
            'editing.membership_type_id' => 'required',
            'proxy_start_date' => ['nullable', new inputdate],
            'editing.status' => 'required',
        ];
    }

    public function mount()
    {
        $this->membershipTypes = selectedOrganisation()->membershipTypes;
    }

    public function updated($name,$value)
    {
        if($name == 'proxy_start_date'){
            $this->proxy_start_date = str_replace('/','-',$value) ;
        }  
    }

    public function edit(Membership $membership)
    {
        $this->editing = $membership;

        $this->proxy_start_date = optional($this->editing->start_date)->format('d-m-Y'); 
        $this->showEditMembershipModal = true;
    }

    /**
     * Save Membership
     */
    public function saveMembership()
    {
        $this->validate();
        
        $this->editing->start_date = new Carbon($this->proxy_start_date); // proxy date must be in dd-mm-yyyy NOT dd/mm/yyyyformat

        $this->editing->save();
        $this->showEditMembershipModal = false;
    }

    public function deleteMembership()
    {

        $this->editing->delete();

        // Close both modals
        $this->showConfirmDeleteMembershipModal = false;
        $this->showEditMembershipModal = false;

    }
  
    public function render()
    {
        $this->memberships = selectedOrganisation()->memberships()
        ->where('memberships.name','LIKE','%'.$this->search .'%')
        ->orderBy('name')
        ->with(['members','membershipType'])
        ->get();

        
       
        return view('livewire.members-register');
    }
}
