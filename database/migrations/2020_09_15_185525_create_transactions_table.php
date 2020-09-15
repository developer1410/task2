<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30);
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('wallet_id')->nullable();
            $table->unsignedInteger('deposit_id')->nullable();
            $table->double('amount', 10, 2);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('deposit_id')
                ->on('deposits')
                ->references('id');

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
        Schema::dropIfExists('transactions');
    }
}
