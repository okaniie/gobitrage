<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->integer('referral_user_id');
            $table->string('referral_username')->nullable();
            $table->integer('referred_user_id');
            $table->string('referred_username')->nullable();
            $table->enum('referral_paid', [0, 1])->default(0);
            $table->decimal('referral_bonus', 10,2)->default(0);
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
        Schema::dropIfExists('referrals');
    }
}
