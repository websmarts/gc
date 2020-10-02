<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Organisation;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisations = Organisation::with('MembershipTypes')->take(5)->get();

        

        $faker = new Faker;
        $faker->addProvider(new \Faker\Provider\DateTime($faker));

        foreach($organisations as $org)
        {           
            foreach($org->membershipTypes as $type)
            {
        
                // DB::table('memberships')->insert([
                //     'membership_type_id' => $type->id,
                //     'name' => 'membership name',
                //     'start_date' => $faker->date(),
                //     'status' => 'active'

                // ]);
                $membership = \App\Models\Membership::create(
                        [
                            'membership_type_id' => $type->id,
                            'name' => 'membership name',
                            'start_date' => $faker->date(),
                            'status' => 'active'
                        ]
                    );
                // $m = rand(0,$type->max_people);
                $m = $type->max_people;
                for($n=0;$n < $m; $n++)   {
                    $membership->members()
                    ->attach(Contact::factory(1)->create(['organisation_id'=>$org->id])->first()->id,['is_primary_contact'=> $n==0]);
                } 
                // create some contacts that are not members
                Contact::factory(2)->create(['organisation_id'=>$org->id]);
            }
        }
    }
}
