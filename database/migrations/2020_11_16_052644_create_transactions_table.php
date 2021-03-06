<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // eg payment request, refund, adjustment, etc
            $table->string('regarding')->nullable(); // eg membership renewal for membership ||  account renewal for organisation
            $table->unsignedBigInteger('membership_id')->default(0); // membership_id if membership renewal
            $table->unsignedBigInteger('organisation_id')->default(0); // organisation_id if account renewal
            $table->float('gross_amount_charged')->default(0); // gross invoice amount
            $table->string('processors_transaction_id')->nullable(); // payment gateway transaction id
            $table->string('response_status_code')->nullable(); // eg 201 = all good
            $table->string('payee_name')->nullable();
            $table->float('gross_amount_paid')->default(0); // the amount actuall charged to the payee
            $table->float('net_amount_received')->default(0); // eg after paypal takes their fee
            $table->datetime('when_received')->nullable();
            $table->integer('created_by')->default(0); // user id if manually done or 0 = system
            $table->string('note')->nullable(); // eg why adjustment was made

            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
