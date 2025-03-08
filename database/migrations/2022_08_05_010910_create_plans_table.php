<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_category_id');
            $table->string('title');
            $table->integer('ordering')->default(0);
            $table->enum('has_badge', [0, 1])->default(0);
            $table->decimal('minimum', 10, 2)->nullable();
            $table->decimal('maximum', 10, 2)->nullable();
            $table->decimal('percentage', 10, 2)->nullable();
            $table->decimal('referral_percentage', 10, 2)->nullable();
            $table->enum('duration_type', ['minute', 'hour', 'day', 'week', 'month', 'year']);
            $table->enum('profit_frequency', ['end', 'minute', 'hour', 'day', 'week', 'month', 'year']);
            $table->integer('duration');
            $table->enum('status', [0, 1])->default(1);
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
        Schema::dropIfExists('plans');
    }
}
