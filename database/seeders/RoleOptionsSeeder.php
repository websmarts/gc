<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'President/Chair',
            'Vice President/Vice Chair',
            'Secretary',
            'Treasurer',
            'Board/Committee general member',
            'Other',
        ];

        foreach($roles as $role)
        {
            DB::table('role_options')->insert(['role'=>$role]);
        }
    }
}
