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
    protected $signature = 'deposit:percent {deposit_id}';

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
        $deposit = Deposit::find($this->argument('deposit_id'));

        // Todo finish this

        return 0;
    }
}
