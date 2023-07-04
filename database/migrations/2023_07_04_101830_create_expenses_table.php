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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_expense_category_id')->nullable();
            $table->foreign('main_expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
            $table->unsignedBigInteger('sub_expense_category_id')->nullable();
            $table->foreign('sub_expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->double('value')->default(0);
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
        Schema::dropIfExists('expenses');
    }
};
