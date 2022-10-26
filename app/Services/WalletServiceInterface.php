<?php

namespace App\Services;

interface WalletServiceInterface
{
    /**
     * @param int $userId
     *
     * @return int
     */
    public function getBalance(int $userId): int;

    /**
     * @param int $userId
     * @param int $amount
     *
     * @return int
     */
    public function addMoney(int $userId, int $amount): int;
}
