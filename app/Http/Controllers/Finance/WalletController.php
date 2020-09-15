<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $request->validate([
            'balance_amount' => 'required|numeric'
        ]);
        $user = auth()->user();
        $user->wallet->balance += $request->balance_amount;
        if($user->wallet->save()) {
            $user->wallet->transactions()->create([
                'type' => 'enter',
                'amount' => $request->balance_amount,
                'user_id' => $user->id
            ]);
        }
        return redirect()->back();
    }
}
