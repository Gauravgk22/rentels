<?php

namespace App\Modules\Wallet\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use App\Modules\Core\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService extends BaseService
{
    public function deposit(int $userId, float $amount, string $description = 'Deposit')
    {
        return DB::transaction(function () use ($userId, $amount, $description) {
            $wallet = Wallet::firstOrCreate(['user_id' => $userId], ['balance' => 0]);
            $wallet->increment('balance', $amount);

            return Transaction::create([
                'wallet_id' => $wallet->id,
                'amount' => $amount,
                'type' => 'deposit',
                'status' => 'completed',
                'description' => $description,
            ]);
        });
    }

    public function pay(int $userId, float $amount, string $referenceType, int $referenceId, string $description)
    {
        return DB::transaction(function () use ($userId, $amount, $referenceType, $referenceId, $description) {
            $wallet = Wallet::where('user_id', $userId)->first();
            if (!$wallet || $wallet->balance < $amount) {
                throw new Exception('Insufficient balance');
            }

            $wallet->decrement('balance', $amount);

            return Transaction::create([
                'wallet_id' => $wallet->id,
                'amount' => -$amount,
                'type' => 'payment',
                'status' => 'completed',
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }
}
