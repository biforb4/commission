<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator;

use App\Service\CommissionCalculator\CalculationStrategy\StrategyFactory;
use App\Service\ExchangeRate\ExchangeRateProviderInterface;

class Calculator implements CommissionCalculatorInterface
{
    private const BASE_CURRENCY = 'EUR';

    public function __construct(private StrategyFactory $factory, private ExchangeRateProviderInterface $provider)
    {
    }

    public function calculate(Transaction $transaction): string
    {
        $strategy = $this->factory->create($transaction);

        if (self::BASE_CURRENCY === $transaction->currency) {
            return $strategy->calculateCommission($transaction);
        }

        $rate = $this->provider->getRate(self::BASE_CURRENCY, $transaction->currency);

        if (0 === bccomp($rate, '0', 8)) {
            return $strategy->calculateCommission($transaction);
        }

        $amountInEUR = bcdiv($transaction->amount, $rate, 8);

        return $strategy->calculateCommission($transaction->convertToEUR($amountInEUR));
    }
}
