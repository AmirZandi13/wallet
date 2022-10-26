<?php

namespace App\Services\v1;

use App\Exceptions\UserHasNotEnoughBalanceException;
use App\Models\Repositories\WalletRepository;
use App\Services\WalletServiceInterface;

class WalletService implements WalletServiceInterface
{
    /**
     * @param WalletRepository $walletRepository
     */
    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * @param int $userId
     *
     * @return int
     */
    public function getBalance(int $userId): int
    {
        return $this->walletRepository->getBalanceByUserId($userId);
    }

    /**
     * @param int $userId
     * @param int $amount
     *
     * @return int
     */
    public function addMoney(int $userId, int $amount): int
    {
        $checkUserExists = $this->walletRepository->checkUserWalletExists($userId);

        if (! $checkUserExists) {
            $this->walletRepository->createUserWallet($userId, $amount);
        }

        if ($amount < 0) {
            if (! $this->walletRepository->checkUserHasEnoughBalance($userId, $amount)) {
                throw new UserHasNotEnoughBalanceException();
            }
        }

        return $this->walletRepository->addMoneyToWallet($userId, $amount);
    }
}
