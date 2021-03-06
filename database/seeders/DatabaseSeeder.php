<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UserSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(RoleOptionsSeeder::class);
        $this->call(OrganisationSeeder::class);
        $this->call(OrganisationMembershipTypeSeeder::class);
        // $this->call(MembershipSeeder::class);
        // $this->call(ContactRoleSeeder::class);
        // $this->call(TransactionSeeder::class);
        // $this->call(RenewalSeeder::class);
    }
}
