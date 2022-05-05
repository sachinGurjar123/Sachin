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
        Schema::create('vehicle_route_time_management', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id');
            $table->bigInteger('total_available_seats')->default(0);
            $table->bigInteger('total_filled_seats')->default(0);
            $table->dateTime('arrival_time')->nullable();
            $table->dateTime('departure_time')->nullable();
            $table->text('source_point')->nullable();
            $table->text('destination_point')->nullable();
            $table->bigInteger('price')->default(0);
            $table->tinyInteger('tracable')->default(0)->comment('0:No 1:Live');
            $table->tinyInteger('is_active')->default(1)->comment('1: Active 0:Inactive');
            $table->tinyInteger('is_approved')->default(0)->comment('0:Pending 1: Approved 2:Rejected');
            $table->text('rejected_reason')->nullable();
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
        Schema::dropIfExists('vehicle_route_time_management');
    }
};
