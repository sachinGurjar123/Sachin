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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vrtm_id');
            $table->bigInteger('booking_id');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->bigInteger('age')->nullable();
            $table->string('gender');
            $table->string('document')->nullable();
            $table->string('seat_no');
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
        Schema::dropIfExists('passengers');
    }
};
