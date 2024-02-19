<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator\CalculationStrategy;

use App\Exception\ApplicationException;
use App\Service\CommissionCalculator\Transaction;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class StrategyFactory
{
    /** @param iterable<CalculationStrategyInterface> $strategies */
    public function __construct(#[AutowireIterator('app.calculation_strategy')] private iterable $strategies)
    {
    }

    public function create(Transaction $transaction): CalculationStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($transaction)) {
                return $strategy;
            }
        }

        throw new ApplicationException('Unable to find calculation strategy');
    }
}
