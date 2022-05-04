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
    //php artisan migrate:refresh --path=/database/migrations/2022_03_08_132526_create_master_otps_table.php
    public function up()
    {
        Schema::create('master_otps', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_no')->nullable();
            $table->string('otp')->nullable();
            $table->string('role_id')->nullable();
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
        Schema::dropIfExists('master_otps');
    }
};
