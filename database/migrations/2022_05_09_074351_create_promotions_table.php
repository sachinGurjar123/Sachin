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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promocode', 100)->nullable();
            $table->string('description')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();

            $table->string('discount_type', 20)->nullable()->comment('percentage', 'amount');
            $table->bigInteger('discount_value')->nullable();
            $table->timestamp('start_datetime')->nullable();
            $table->timestamp('end_datetime')->nullable();
            $table->bigInteger('max_use')->nullable();
            $table->bigInteger('min_cart_amount')->nullable();
            $table->bigInteger('left_use')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('promotions');
    }
};
