<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('membership_type_id');
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('fee_due_date')->nullable();
            $table->integer('fee_due_amount')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('membership_type_id')->references('id')->on('membership_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
