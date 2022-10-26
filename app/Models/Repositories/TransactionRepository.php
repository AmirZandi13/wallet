<?php

namespace App\Models\Repositories;

use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
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
}
