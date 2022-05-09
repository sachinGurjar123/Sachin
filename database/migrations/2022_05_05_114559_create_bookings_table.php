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
            $table->bigInteger('vrm_id');
            $table->bigInteger('vehicle_id');
            $table->bigInteger('user_id');
            $table->bigInteger('bus_type_id');
            $table->bigInteger('total_price');
            $table->bigInteger('total_passengers');

            $table->bigInteger('source_vehicle_point_id')->nullable();
            $table->bigInteger('drop_vehicle_point_id')->nullable();
            $table->bigInteger('promotion_id')->nullable();
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
