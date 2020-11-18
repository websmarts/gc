<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipRenewalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_renewals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id');
            $table->unsignedBigInteger('transaction_id')->nullable();// for payment details
            $table->datetime('issued_date');// probably the same as created_at
            $table->datetime('response_date')->nullable(); // eg record when renewal page visited after email sent

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_renewals');
    }
}
