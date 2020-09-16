<?php

namespace App\Console\Commands;

use App\Deposit;
use App\Transaction;
use App\User;
use Illuminate\Console\Command;

class AddDepositPercentageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit:accrue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add percentage to deposit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deposits = Deposit::where('accrue_times', '<', 10)->get();

        if($deposits->count()) {
            foreach($deposits as $deposit) {
                $amount = $deposit->accrue;
                $times = $deposit->accrue_times + 1;

                $deposit->increment('invested', $amount, [
                    'accrue_times' => $times
                ]);

                $deposit->user->transactions()->create([
                    'type' => Transaction::TYPE_ADD_PERCENTS,
                    'amount' => $amount,
                    'deposit_id' => $deposit->id
                ]);
                $this->info("Percents: $amount was added to deposit with id: $deposit->id");
            }
        }

        return 0;
    }
}
