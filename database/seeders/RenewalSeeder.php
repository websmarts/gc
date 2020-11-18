<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\MembershipRenewal;

class RenewalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembershipRenewal::create([
            'membership_id'=>2,
            'transaction_id'=>1,
            'issued_date'=>Carbon::now()->addYear(-1),
            
        ]);

        MembershipRenewal::create([
            'membership_id'=>2,
            'transaction_id'=>2,
            'issued_date'=>Carbon::now()->addDay(-35),
            
        ]);
    }
}
