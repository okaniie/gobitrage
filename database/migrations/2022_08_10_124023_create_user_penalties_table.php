<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_penalties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('token');
            $table->string('currency_code');
            $table->decimal('amount', 10, 2)->nullable();
            $table->boolean('notify')->default(0);
            $table->string('message')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
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
        Schema::dropIfExists('user_penalties');
    }
}
