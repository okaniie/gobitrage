<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('btc_address')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('usdt_erc_address')->nullable();
            $table->string('ltc_address')->nullable();
            $table->string('usdt_trc_address')->nullable();
            $table->string('doge_address')->nullable();
            $table->string('trx_address')->nullable();
            $table->string('bnb_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'btc_address',
                'eth_address',
                'usdt_erc_address',
                'ltc_address',
                'usdt_trc_address',
                'doge_address',
                'trx_address',
                'bnb_address'
            ]);
        });
    }
}; 