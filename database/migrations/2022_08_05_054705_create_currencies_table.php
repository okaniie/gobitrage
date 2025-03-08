<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('display_name');
            $table->enum('status', [0, 1])->default(0);
            $table->enum('deposit_from_balance', [0, 1])->default(0);
            $table->enum('deposit_from_processor', [0, 1])->default(1);
            $table->string('deposit_processor')->nullable();
            $table->string('deposit_address')->nullable();
            $table->decimal('deposit_min', 10, 2)->default(0);
            $table->decimal('deposit_max', 10, 2)->default(0);
            $table->decimal('deposit_fees_percentage', 10, 2)->default(0);
            $table->decimal('deposit_fees_additional', 10, 2)->default(0);
            $table->decimal('deposit_fees_min', 10, 2)->default(0);
            $table->decimal('deposit_fees_max', 10, 2)->default(0);
            $table->string('withdrawal_processor')->nullable();
            $table->decimal('withdrawal_min', 10, 2)->default(0);
            $table->decimal('withdrawal_max', 10, 2)->default(0);
            $table->decimal('withdrawal_fees_percentage', 10, 2)->default(0);
            $table->decimal('withdrawal_fees_additional', 10, 2)->default(0);
            $table->decimal('withdrawal_fees_min', 10, 2)->default(0);
            $table->decimal('withdrawal_fees_max', 10, 2)->default(0);
            $table->enum('auto_withdrawal', [0, 1])->default(0);
            $table->decimal('auto_withdrawal_min', 10, 2)->default(0);
            $table->decimal('auto_withdrawal_max', 10, 2)->default(0);
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
        Schema::dropIfExists('currencies');
    }
}
