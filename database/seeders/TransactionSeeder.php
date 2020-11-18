<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'type' => 'income',
            'regarding' => 'membership renewal', // membership renewal
            'membership_id' => 2,
            'gross_amount_charged' => "25.00",
            'processors_transaction_id' => 1,
            'when_received' => Carbon::now()->addDay(-200),
            'gross_amount_paid' => "25.00",
            'net_amount_received' => "24.10"
        ]);

        Transaction::create([
            'type' => 'income',
            'regarding' => 'membership renewal', // membership renewal
            'membership_id' => 2,
            'gross_amount_charged' => "25.00",
            'processors_transaction_id' => 7,
            'when_received' => Carbon::now()->addDay(-30),
            'gross_amount_paid' => "25.00",
            'net_amount_received' => "24.10"
        ]);
        Transaction::create([
            'type' => 'income',
            'regarding' => 'subscription',// organisation account subscription
            'organisation_id' => 1,
            'gross_amount_charged' => "125.00",
            'processors_transaction_id' => 23,
            'when_received' => Carbon::now()->addDay(-45),
            'gross_amount_paid' => "125.00",
            'net_amount_received' => "121.10"
        ]);
    }
}
