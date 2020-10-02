<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => Str::uuid(),
            'is_admin' => 1,
            'name' => 'System Administrator',
            'email' => 'sysadmin@here.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('password')
        ]);

        User::create([
            'uuid' => Str::uuid(),
            'is_admin' => 0,
            'name' => 'Ian Maclagan',
            'email' => 'ian@websmarts.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('password')
        ]);

        User::factory(50)->create();
    }
}
