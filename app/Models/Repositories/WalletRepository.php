<?php

namespace App\Models\Repositories;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WalletRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(app()->make(Wallet::class));
        $this->transactionRepository = app()->make(TransactionRepository::class);
    }

    /**
     * @param int $userId
     *
     * @return int
     */
    public function getBalanceByUserId(int $userId): int
    {
        $wallet = $this->model->where('user_id', $userId)->first();

        return $wallet ? $wallet->balance : 0;
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkUserWalletExists(int $userId): bool
    {
        $wallet = $this->model->where('user_id', $userId)->first();

        return (bool)$wallet;
    }

    /**
     * @param int $userId
     *
     * @return Wallet
     */
    public function createUserWallet(int $userId, int $amount): Wallet
    {
        $wallet = $this->model->create([
            'user_id' => $userId
        ]);

        return $wallet;
    }

    /**
     * @param int $userId
     *
     * @return int
     */
    public function addMoneyToWallet(int $userId, int $amount): int
    {
        DB::beginTransaction();

        try {
            $wallet = $this->model->where('user_id', $userId)->first();

            $wallet->update([
                'balance' => $wallet->balance + $amount
            ]);

            $transaction = $this->transactionRepository->createTransaction($wallet->id, $amount);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $transaction = app()->make(Transaction::class);
        }

        return $transaction->exists ? $transaction->reference_id : 0;
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkUserHasEnoughBalance(int $userId, int $amount): bool
    {
        $wallet = $this->model->where('user_id', $userId)->first();

        return ($wallet->balance + $amount) >= 0;
    }
}
