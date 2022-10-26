<?php

namespace App\Console\Commands;

use App\Models\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateTransactionsAmount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:calculation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the total amount of transactions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transactionRepository = app()->make(TransactionRepository::class);

        $totalAmount = $transactionRepository->getAmountOfTransactions(Carbon::yesterday(), Carbon::now());

        echo "The total amount is: $totalAmount \n";

        return Command::SUCCESS;
    }
}
