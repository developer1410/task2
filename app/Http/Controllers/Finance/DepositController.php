<?php

namespace App\Http\Controllers\Finance;

use App\Deposit;
use App\Http\Controllers\Controller;
use App\Services\DepositService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    protected $depositService = null;

    /**
     * DepositController constructor.
     * @param DepositService $depositService
     */
    public function __construct(DepositService $depositService)
    {
        $this->depositService = $depositService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        return view('deposits', [
            'data' => $this->depositService->getDeposits(auth()->user()->id)
        ]);
    }

    /**
     * Create deposit
     * @param Request $request
     * @param $depositService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, DepositService $depositService) {
        $user = auth()->user();
        // validate parameters
        $request->validate([
            'deposit_amount' => 'required|numeric|min:10|max:100|max:' . $user->wallet->balance,
            'deposit_duration' => 'required|int'
        ]);

        $depositService->createDeposit(
            $user,
            $request->deposit_amount,
            $request->deposit_duration
        );

        return redirect()->back();
    }
}
