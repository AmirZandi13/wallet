<?php

namespace Tests\Feature;

use App\Constants\Errors;
use App\Exceptions\UserHasNotEnoughBalanceException;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\v1\WalletService;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function app;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->walletService = app()->make(WalletService::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_process_of_adding_money_balance()
    {
        $this->seed(WalletSeeder::class);
        $balanceBeforeAddingMoney = $this->walletService->getBalance(1);

        $amount = rand(1000, 10000);

        $this->walletService->addMoney(1, $amount);


        $balanceAfterAddingMoney = $this->walletService->getBalance(1);

        $this->assertEquals($balanceAfterAddingMoney, $balanceBeforeAddingMoney + $amount);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_process_of_adding_negative_money_balance_when_user_does_not_have_enough_balance()
    {
        $this->expectException(UserHasNotEnoughBalanceException::class);
        $this->expectExceptionMessage(Errors::USER_HAS_NOT_ENOUGH_BALANCE);

        $this->seed(WalletSeeder::class);
        $this->walletService->addMoney(1, 1000);
        $this->walletService->addMoney(1, -2000);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_process_of_adding_negative_money_balance_when_user_has_enough_balance()
    {
        $this->seed(WalletSeeder::class);
        $this->walletService->addMoney(1, 3000);
        $this->walletService->addMoney(1, -2000);

        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_transactions_count_when_add_money()
    {
        $this->seed(WalletSeeder::class);
        $countOfAddingMoney = rand(1, 100);

        for ($i = 0; $i < $countOfAddingMoney; $i++) {
            $this->walletService->addMoney(1, 200);
        }

        $wallet = Wallet::where('user_id', 1)->first();
        $countOfTransactions = Transaction::where('wallet_id', $wallet->id)->count();

        $this->assertEquals($countOfAddingMoney, $countOfTransactions);
    }
}
