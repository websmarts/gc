<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uuid')->unique();
            $table->string('slug')->unique();
            $table->string('abn')->nullable();
            $table->boolean('gst_registered')->nullable();
            $table->unsignedBigInteger('address_id');
            $table->string('phone')->nullable();
            $table->string('bank_account_details')->nullable();
            $table->text('settings')->nullable();

            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
