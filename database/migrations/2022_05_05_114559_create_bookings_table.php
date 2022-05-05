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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vrtm_id');
            $table->bigInteger('user_id');
            $table->bigInteger('bus_type_id');
            $table->bigInteger('price');
            $table->string('source_point');
            $table->string('drop_point');
            $table->tinyInteger('status')->default(0)->comment('0:Pending 1:Confirmed 2:Cancelled 3:Rejected 4:Completed');
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
        Schema::dropIfExists('bookings');
    }
};
