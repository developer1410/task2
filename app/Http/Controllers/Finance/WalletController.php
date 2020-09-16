<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Services\WalletService;
use App\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, WalletService $walletService) {
        $request->validate([
            'balance_amount' => 'required|numeric'
        ]);
        $walletService->credit(auth()->user(), $request->balance_amount);
        return redirect()->back();
    }
}
