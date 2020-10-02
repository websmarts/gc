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
            'Australian Capital Territory',
            'New South Wales',
            'Northern Territory',
            'Queensland',
            'South Australia',
            'Tasmania',
            'Victoria', 
            'Western Australia',
        ];
        
        foreach ($states as $state){
            DB::table('states')->insert([
            'name' => $state
        ]);

        }
        
    }
}
