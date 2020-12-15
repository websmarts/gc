<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'Australian Capital Territory'=>'ACT',
            'New South Wales'=>'NSW',
            'Northern Territory'=>'NT',
            'Queensland'=>'QLD',
            'South Australia'=>'SA',
            'Tasmania'=>'TAS',
            'Victoria'=>'VIC', 
            'Western Australia'=>'WA',
        ];
        
        foreach ($states as $state=>$code){
            DB::table('states')->insert([
            'name' => $state,
            'code' => $code,
        ]);

        }
        
    }
}
