<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisations = \App\Models\Organisation::all();
        $roles = \App\Models\RoleOption::all();


        foreach ($organisations as $org) {

            $contacts = \App\Models\Contact::query()
                ->where('organisation_id',$org->id)
                ->limit( $roles->count() )
                ->get();

            foreach($roles as $role) {
                if($contact = $contacts->pop() ){
                    \App\Models\OrganisationRole::create([
                        'organisation_id' => $org->id,
                        'contact_id' => $contact->id,
                        'role_id' => $role->id
                    ]);
                }
                

            }
        }
        //    foreach contactRole
        // assign an org contact to the role
    }
}
