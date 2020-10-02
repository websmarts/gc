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
        // User::factory(10)->create();

        $this->call(UserSeeder::class);
        

        $this->call(StateSeeder::class);
        $this->call(RoleOptionsSeeder::class);
        $this->call(OrganisationSeeder::class);
        $this->call(OrganisationMembershipTypeSeeder::class);
        $this->call(MembershipSeeder::class);
        $this->call(ContactRoleSeeder::class);
    }
}
