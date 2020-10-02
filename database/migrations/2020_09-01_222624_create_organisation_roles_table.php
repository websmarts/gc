<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganisationRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_roles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('organisation_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('role_id');
            
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('role_id')->references('id')->on('role_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_roles');
    }
}
