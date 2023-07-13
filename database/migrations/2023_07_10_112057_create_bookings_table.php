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
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            //====================================================
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('category_id')->references('id')->on('rooms_categories');
            $table->foreign('client_id')->references('id')->on('clients');
            //====================================
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('num_days')->nullable();
            $table->string('num_of_adult')->nullable();
            $table->string('num_of_children')->nullable();
            $table->string('notes')->nullable();
            $table->double('total_before_discount')->nullable();
            $table->double('discount')->nullable();
            $table->double('total_after_discount')->nullable();
            $table->unsignedBigInteger('publisher')->nullable();
            $table->foreign('publisher')->references('id')->on('admins');
            $table->string('date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
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
