<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_facilities', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned();     
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            
            $table->bigInteger('facility_id')->unsigned();     
            $table->foreign('facility_id')->references('id')->on('facilities')->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_facilities');
    }
};
