<?php

namespace Tests\Feature\Services;

use App\Services\v1\WalletService;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function app;

class WalletServiceTest extends TestCase
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
    public function test_get_balance_should_return_an_integer()
    {
        $this->seed(WalletSeeder::class);
        $balance = $this->walletService->getBalance(1);
        $this->assertEquals('integer', gettype($balance));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_money_should_return_an_integer()
    {
        $this->seed(WalletSeeder::class);
        $balance = $this->walletService->addMoney(1, 2000);
        $this->assertEquals('integer', gettype($balance));
    }
}
