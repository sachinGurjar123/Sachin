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
            $table->bigInteger('vr_id');
            $table->bigInteger('vehicle_id');
            $table->bigInteger('booking_id');
            $table->string('name', 255)->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('age')->nullable();
            $table->string('gender', 10);
            $table->string('document', 150)->nullable();
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
