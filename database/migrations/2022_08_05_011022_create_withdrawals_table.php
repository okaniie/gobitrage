<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('transaction_id')->nullable();
            $table->string('username')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('charges', 10, 2)->default(0);
            $table->double('crypto_amount')->nullable();
            $table->string('crypto_currency')->nullable();
            $table->string('address')->nullable();
            $table->string('status_link')->nullable();
            $table->enum('status', ['pending', 'declined', 'approved'])->default('pending');
            $table->string('message_from_user')->nullable();
            $table->string('message_from_admin')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}
