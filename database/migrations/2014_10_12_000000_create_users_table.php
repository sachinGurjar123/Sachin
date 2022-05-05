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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile_no')->unique();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('lang')->default('en');
            $table->tinyInteger('is_active')->default(1)->comment('1: Active 0:Inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('device_id')->nullable();
            $table->string('device_type')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
