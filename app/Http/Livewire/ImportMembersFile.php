<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Contact;
use Livewire\Component;
use App\Models\Membership;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;


class ImportMembersFile extends Component
{
    use WithFileUploads;
    
   public $upload;

   public function updatedUpload()
   {
       
       $path = $this->upload->path();

            $collection = (new FastExcel)->import($path);

            $memberships =  $collection->groupBy('membership_name');

            $memberships->each(function ($items, $key) {

                DB::transaction(function() use($items) 
                {

                    $data = $items->shift();

                    if (!$data['membership_name']) {
                        return;
                    }
                    // echo 'primary contact '.$data['contact_name'].'-----------------<br />';
                    // Create Membership
                    $membership = Membership::create([
                        'membership_type_id' => 1,
                        'status' => 'active',
                        'name' => $data['membership_name'],
                        'start_date' => !empty($data['start_date']) ? $data['start_date'] : null,
                        'fee_due_date' => !empty($data['fee_due_date']) ? $data['fee_due_date'] : null,

                    ]);

                    $primaryContactAddress = Address::create([
                        'address1' => $data['address1'],
                        'city' => $data['city'],
                        'postcode' => $data['postcode'],
                        'state_id' => 7

                    ]);

                    $primaryContact = Contact::create([
                        'organisation_id' => 1,
                        'uuid' => (string) Str::uuid(),
                        'name' => $data['contact_name'],
                        'email' => !empty($data['email']) ? $data['email'] : null,
                        'email_verified_at' => !empty($data['email']) ? Carbon::now()->toDateTimeString() : null,
                        'phone' => !empty($data['phone']) ? $data['phone'] : null,
                        'address_id' => $primaryContactAddress->id,

                    ]);   
                    
                    $membership->members()->attach($primaryContact, ['is_primary_contact' => !empty($data['email'])]); // only set primary contact if email exists

                    // Add any remaining members from other items
                    $items->each(function ($data, $key) use ($membership) {
                        //echo $data['contact_name'].'<br />';
                        $addressId=null;
                        if (!empty($data['address1'])) {
                            $address = Address::create([
                                'address1' => $data['address1'],
                                'city' => $data['city'],
                                'postcode' => $data['postcode'],
                                'state_id' => 7

                            ]);
                            $addressId = $address->id;
                        }

                        $contact = Contact::create([
                            'organisation_id' => 1,
                            'uuid' => (string) Str::uuid(),
                            'name' => $data['contact_name'],
                            'email' => !empty($data['email']) ? $data['email'] : null,
                            'email_verified_at' => !empty($data['email']) ? Carbon::now()->toDateTimeString() : null,
                            'phone' => !empty($data['phone']) ? $data['phone'] : null,
                            'address_id' => $addressId,

                        ]);
                        

                        $membership->members()->attach($contact);
                    });
                });

                return redirect()->route('members.register');
            });
   }
}
