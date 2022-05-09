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
        Schema::create('vehicle_points', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->nullable()->comment('1:boarding point, 2:dropping point');
            $table->text('name')->nullable();
            $table->text('detail')->nullable();
            $table->time('time')->nullable();
            $table->string('sort_order')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('1: Active 0:Inactive');
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
        Schema::dropIfExists('vehicle_points');
    }
};
