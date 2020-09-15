<?php

namespace App\Http\Controllers\Finance;

use App\Deposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {

        $deposits = Deposit::where('user_id', '=', auth()->user()->id)
            ->with('transactions')
            ->get();

        $data = [];
        foreach($deposits as $deposit) {
            $data[] = [
                $deposit->id,
                $deposit->invested,
                $deposit->percent,
                count($deposit->transactions),
                $deposit->transactions()->sum('amount'),
                $deposit->active ? 'Active' : 'Inactive',
                $deposit->created_at
            ];
        }

        return view('deposits', compact('data'));
    }

    /**
     * Create deposit
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $user = auth()->user();

        // validate parameters
        $request->validate([
            'deposit_amount' => 'required|numeric|min:10|max:100|max:' . $user->wallet->balance,
            'deposit_duration' => 'required|int'
        ]);

        // create deposit
        $deposit = $user->deposits()->create([
            'wallet_id' => $user->wallet->id,
            'invested' => $request->deposit_amount,
            'percent' => 20,
            'active' => 1,
            'duration' => $request->deposit_duration,
            'accrue_times' => 10
        ]);

        // change balance
        $user->wallet->balance -= $request->deposit_amount;
        $user->wallet->save();

        // create transaction
        $user->transactions()->create([
            'type' => 'create_deposit',
            'wallet_id' => $user->wallet->id,
            'deposit_id' => $deposit->id,
            'amount' => $request->deposit_amount,
        ]);

        return redirect()->back();
    }
}
