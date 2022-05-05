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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('bus_type_id');
            $table->bigInteger('total_seats');
            $table->string('image');
            $table->bigInteger('avg_rating');
            $table->bigInteger('total_reviews');
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
        Schema::dropIfExists('vehicles');
    }
};
