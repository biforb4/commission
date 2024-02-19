<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator\CalculationStrategy;

use App\Service\CommissionCalculator\Transaction;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.calculation_strategy')]
interface CalculationStrategyInterface
{
    public function calculateCommission(Transaction $transaction): string;

    public function supports(Transaction $transaction): bool;
}
