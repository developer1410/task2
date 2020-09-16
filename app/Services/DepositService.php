<?php


namespace App\Services;

use App\Deposit;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\DB;

class DepositService
{
    /**
     * Get list of deposits
     * @param $user_id
     * @return array
     */
    public function getDeposits($user_id) {
        $deposits = Deposit::where('user_id', '=', $user_id)
            ->with('transactions')
            ->get();

        $data = [];
        foreach($deposits as $deposit) {
            $transactions = $deposit->transactions()->where('type', '=', Transaction::TYPE_ADD_PERCENTS);
            $data[] = [
                $deposit->id,
                $deposit->invested,
                $deposit->percent,
                $transactions->count(),
                $transactions->sum('amount'),
                $deposit->active ? 'Active' : 'Inactive',
                $deposit->created_at
            ];
        }
        return $data;
    }

    /**
     * Create deposit
     * @param $user
     * @param $deposit_amount
     * @param $deposit_duration
     */
    public function createDeposit($user, $deposit_amount, $deposit_duration) {
        DB::transaction(function() use($user, $deposit_amount, $deposit_duration) {
            // create deposit
            $deposit = $user->deposits()->create([
                'wallet_id' => $user->wallet->id,
                'invested' => $deposit_amount,
                'percent' => 20,
                'active' => 1,
                'duration' => $deposit_duration,
                'accrue_times' => 10
            ]);

            // change balance
            $user->wallet->decrement('balance', $deposit_amount);

            // create transaction
            $user->transactions()->create([
                'type' => Transaction::TYPE_CREATE_DEPOSIT,
                'wallet_id' => $user->wallet->id,
                'deposit_id' => $deposit->id,
                'amount' => $deposit_amount,
            ]);
        });
    }
}
