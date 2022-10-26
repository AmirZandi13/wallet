<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMoneyRequest;
use App\Http\Requests\BalanceRequest;
use App\Http\Resources\AddMoneyResource;
use App\Http\Resources\BalanceResource;
use App\Services\WalletServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * @param WalletServiceInterface $walletService
     */
    public function __construct(WalletServiceInterface $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * @param BalanceRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBalance(BalanceRequest $request)
    {
        $userId = $request->get('user_id');

        $response = $this->walletService->getBalance($userId);

        return response()->json([
            'data' => new BalanceResource($response)
        ], Response::HTTP_OK);
    }

    public function addMoney(AddMoneyRequest $request)
    {
        $userId = $request->get('user_id');
        $amount = $request->get('amount');

        $response = $this->walletService->addMoney($userId, $amount);

        return response()->json([
            'data' => new AddMoneyResource($response)
        ], Response::HTTP_OK);
    }
}
