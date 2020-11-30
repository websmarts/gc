<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use App\Models\Organisation;
use Illuminate\Database\Seeder;


class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Neerim District Landcare Group';
        $org = Organisation::create([
            'uuid'=>Str::uuid(),
            'name'=> $name,
            'slug'=> Str::slug($name.'-'),
            'address_id' => Address::create([
                'address1'=>'P.O. Box 68',
                'city' => 'Neerim South',
                'postcode' => '3831',
                'state_id' => 7,
            ])->id,
            'gst_registered' => 1,
            'abn' => '18 186 920 582',
            'phone' => '',
            'bank_account_details'=>'Bendigo Bank Branch - BSB 633 108 A/c No: 1095 13424',
        ]);
        $org->first()->managers()->attach(User::select('id')->where('is_admin', 0)->first()->id,);
        $org->settings()->merge([
            'payment_handler'=>'paypal',
            'PAYPAL_USE_SANDBOX' => true,
            'PAYPAL_SANDBOX_CLIENT_ID' => 'AR_xRpQCuoq2b_n8sgoF3CCg7usHjAHMQwxJjSL6rdb2KNi8yU36F63lVl7jWiExxLW_jXOw5fgI9fdI',
            'PAYPAL_SANDBOX_CLIENT_SECRET' => 'EO-9JT9ltiZ13Ddkmk7yWgM8YHLjX41Cb20WldpZr0_Jbl4Zldy4R5XIGlTSgq-0hYVVBjdJkIAdN0Gs'
            ]);

        
        // for($n = 0; $n <10; $n++){
        //     Organisation::factory(1)
        //     ->create(['address_id'=>Address::factory(1)->create()->first()->id])
        //     ->first()
        //     ->managers()
        //     ->attach(User::find(rand(2,50)));
        // }
            
            
        
        
        //Organisation::factory(5)->create();
    }
}
