<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator\CalculationStrategy;

use App\Service\BinLookup\BinDetailsProvider;
use App\Service\CommissionCalculator\Transaction;

class NonEUCountryStrategy implements CalculationStrategyInterface
{
    public function __construct(private BinDetailsProvider $provider)
    {
    }

    public function calculateCommission(Transaction $transaction): string
    {
        $commission = (float) bcmul($transaction->amount, '0.02', 8);

        return (string) round($commission, 2);
    }

    public function supports(Transaction $transaction): bool
    {
        return !EUCountryEnum::isEuCountry($this->provider->getAlpha2Country($transaction->bin));
    }
}
