<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $transactions = Transaction::where('user_id', '=', auth()->user()->id)
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

        return view('transactions', compact('data'));
    }
}
