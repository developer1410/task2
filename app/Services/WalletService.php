<?php


namespace App\Services;


use App\Transaction;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function credit($user, $amount) {
        DB::transaction(function() use($user, $amount) {
            $user->wallet->increment('balance', $amount);
            $user->wallet->transactions()->create([
                'type' => Transaction::TYPE_ADD_BALANCE,
                'amount' => $amount,
                'user_id' => $user->id
            ]);
        });
    }
}
