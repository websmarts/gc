<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id');
            $table->integer('amount_charged')->nullable();
            $table->integer('amount_received')->nullable();
            $table->string('payment_method'); // eg Stripe, cheque, direct debit,...
            $table->date('payment_received_date');
            $table->date('expiry_date');
            $table->timestamps();

            $table->foreign('membership_id')->references('id')->on('memberships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
