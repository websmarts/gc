<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisation_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('subscription_months')->default(12)->nullable(); // months
            $table->integer('max_people')->default(0); // max number of people that can be associated with subscription
            $table->integer('prorate_signup_fee')->default(0); // default is full joining fee is always charged unless within grace period
            $table->integer('grace_period_days')->default(90); // any full signup paid within grace period applies to following year

            $table->integer('membership_fee')->nullable();
            $table->integer('renewal_month')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index('organisation_id');
            $table->foreign('organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_types');
    }
}
