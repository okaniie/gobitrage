<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('username')->nullable();
            $table->enum('deposit_from', ["balance", "processor"])->nullable();
            $table->integer('plan_id');
            $table->string('plan_title')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('percentage', 10, 2)->nullable();
            $table->string('profit_frequency')->nullable();
            $table->string('address')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('charges', 10, 2)->default(0);
            $table->double('crypto_amount')->nullable();
            $table->string('crypto_currency')->nullable();
            $table->enum('status', ['pending', 'approved', 'released'])->default('pending');
            $table->timestamp('approval_date')->nullable();
            $table->decimal('interest_balance', 10, 2)->default(0);
            $table->timestamp('last_interest_date')->nullable();
            $table->timestamp('final_interest_date')->nullable();
            $table->text('details')->nullable();
            $table->text('processor_details')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
