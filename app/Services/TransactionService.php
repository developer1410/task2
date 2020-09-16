<?php


namespace App\Services;


use App\Transaction;

class TransactionService
{
    /**
     * Get transaction for specific user
     * @param $user_id
     * @return array
     */
    public function getTransactions($user_id) {
        $transactions = Transaction::where('user_id', '=', $user_id)
            ->get();

        $data = [];
        foreach ($transactions as $transaction) {
            $data[] = [
                $transaction->id,
                $transaction->type,
                $transaction->amount,
                $transaction->created_at
            ];
        }

        return $data;
    }

}
