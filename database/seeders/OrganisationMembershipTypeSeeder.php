<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\MembershipType;
use Illuminate\Database\Seeder;

class OrganisationMembershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisations = Organisation::all();

        foreach($organisations as $org)
        {
            MembershipType::create([
                'organisation_id' => $org->id,
                'name' => 'Standard',
                'description' => 'Standard group membership',
                'subscription_months' => 12,
                'max_people' => 6,
                'prorate_signup_fee' => 0,
                'grace_period_days' => 90,
                'membership_fee' => 2500,
                'renewal_month' => 7

            ]);

            // MembershipType::create([
            //     'organisation_id' => $org->id,
            //     'name' => 'Family',
            //     'description' => 'Family membership',
            //     'subscription_months' => 12,
            //     'max_people' => 6,
            //     'prorate_signup_fee' => 0,
            //     'grace_period_days' => 90,
            //     'membership_fee' => 2500,
            //     'renewal_month' => 7

            // ]);
        }
    }
}
