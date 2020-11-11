<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Str;

class ContactsRegister extends Component
{

    public $contacts;

    public $search;

    public $showEditModal = false;
    public $showConfirmDeleteModal = false;

    public $editing;
    

    protected $rules = [
        'editing.name' =>'required',
        'editing.email' => 'sometimes|required|email',
        'editing.phone' => 'sometimes|required',
        'editing.notes'=>'sometimes'
        
    ];

    public function mount()
    {
       
        $this->editing = Contact::make();
    }

    public function create()
    {
        $this->editing = Contact::make();
        $this->showEditModal = true;
    }

    public function edit($id)
    {
        $this->editing = Contact::find($id);
        $this->showEditModal = true;
    }

    public function save()
    {
        $editingData = $this->validate();
        

        if($this->editing->uuid){
            // save existing contact
            $this->editing->save();
        } else {
            // create new contact
            $data = $editingData['editing'];
            $data['uuid'] = Str::uuid();
            $data['organisation_id'] = selectedOrganisation()->id;
            
            Contact::create($data);
        }
        
        $this->showEditModal = false;
    }

    public function delete()
    {
        $this->editing->delete();
        $this->showConfirmDeleteModal = false;
        $this->showEditModal = false;
    }

    public function render()
    {

        $this->contacts = selectedOrganisation()
        ->contacts()
        ->where('name','like','%'.$this->search.'%')
        ->doesntHave('memberships')->get();
        return view('livewire.contacts-register');
    }
}
