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
        Organisation::create([
            'uuid'=>Str::uuid(),
            'name'=> $name,
            'slug'=> Str::slug($name.'-'),
            'address_id' => Address::factory(1)->create()->first()->id,
            'gst_registered' => 1,
            'abn' => '98765456778',
            'phone' => '',
        ])->first()->managers()->attach(User::select('id')->where('is_admin', 0)->first()->id,);

        
        for($n = 0; $n <20; $n++){
            Organisation::factory(1)
            ->create(['address_id'=>Address::factory(1)->create()->first()->id])
            ->first()
            ->managers()
            ->attach(User::find(rand(2,50)));
        }
            
            
        
        
        //Organisation::factory(5)->create();
    }
}
