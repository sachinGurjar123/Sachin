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
    //php artisan migrate:refresh --path=/database/migrations/2022_02_23_091809_add_columns_to_users_table.php
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //ALTER TABLE `users` CHANGE `mobile_no` `mobile_no` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `email`;
            // $table->string('mobile_no')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
