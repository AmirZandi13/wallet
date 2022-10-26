<?php

namespace App\Models\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository extends BaseRepository
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        parent::__construct(app()->make(Transaction::class));
    }

    /**
     * @param int $walletId
     * @param int $amount
     *
     * @return Transaction
     */
    public function createTransaction(int $walletId, int $amount): Transaction
    {
        $transaction = $this->model->create([
            'wallet_id' => $walletId,
            'amount' => $amount,
            'reference_id' => rand(10000000000, 99999999999)
        ]);

        return $transaction;
    }

    /**
     * @param Carbon $fromDate
     * @param Carbon $toDate
     *
     * @return int
     */
    public function getAmountOfTransactions(Carbon $fromDate, Carbon $toDate): int
    {
        $totalAmount = $this->model
            ->where('created_at', '>', $fromDate)
            ->where('created_at', '<', $toDate)
            ->sum('amount');

        return $totalAmount;
    }
}
