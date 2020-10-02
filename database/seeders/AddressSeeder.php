<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Address::create(
            [
                'address1'=> 'P.O.Box 68',
                'address2'=> '',
                'city' => 'Neerim South',
                'postcode' => 3831,
                'state_id' => 7,
            ]
        );
        
        Address::factory(100)->create();
    }
}
