<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @param $transactionService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, TransactionService $transactionService) {
        return view('transactions', [
            'data' => $transactionService->getTransactions(auth()->user()->id)
        ]);
    }
}
