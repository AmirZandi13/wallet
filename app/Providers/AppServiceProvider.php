<?php

namespace App\Providers;

use App\Services\TransactionServiceInterface;
use App\Services\v1\TransactionService;
use App\Services\v1\WalletService;
use App\Services\WalletServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WalletServiceInterface::class, WalletService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
    }
}
