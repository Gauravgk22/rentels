<?php

namespace App\Modules\Wallet\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Wallet\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected WalletService $service;

    public function __construct(WalletService $service)
    {
        $this->service = $service;
    }

    public function balance()
    {
        $wallet = auth('api')->user()->wallet;
        return response()->json(['balance' => $wallet ? $wallet->balance : 0]);
    }

    public function deposit(Request $request)
    {
        $this->validate($request, ['amount' => 'required|numeric|min:1']);
        $transaction = $this->service->deposit(auth('api')->id(), $request->amount);
        return response()->json($transaction);
    }
}
