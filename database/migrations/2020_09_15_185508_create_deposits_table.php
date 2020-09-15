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
            $table->integerIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('wallet_id');
            $table->double('invested', 10, 2);
            $table->double('percent', 5, 2);
            $table->tinyInteger('active');
            $table->smallInteger('duration');
            $table->smallInteger('accrue_times');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('wallet_id')
                ->on('wallets')
                ->references('id');

            $table->foreign('user_id')
                ->on('users')
                ->references('id');
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
