<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\CommissionCalculator;

use App\Service\CommissionCalculator\CalculationStrategy\CalculationStrategyInterface;
use App\Service\CommissionCalculator\CalculationStrategy\StrategyFactory;
use App\Service\CommissionCalculator\Calculator;
use App\Service\CommissionCalculator\Transaction;
use App\Service\ExchangeRate\ExchangeRateProviderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private MockObject|StrategyFactory $factory;
    protected MockObject|ExchangeRateProviderInterface $provider;
    private Calculator $sut;

    protected function setUp(): void
    {
        $this->factory = $this->createMock(StrategyFactory::class);
        $this->provider = $this->createMock(ExchangeRateProviderInterface::class);

        $this->sut = new Calculator($this->factory, $this->provider);
    }

    public function testCalculateForEURTransaction(): void
    {
        $transaction = new Transaction('1', '1', 'EUR');
        $strategy = new class () implements CalculationStrategyInterface {
            public function calculateCommission(Transaction $transaction): string
            {
                return '0.1';
            }

            public function supports(Transaction $transaction): bool
            {
                return true;
            }
        };

        $this->factory->expects($this->once())
            ->method('create')
            ->with($transaction)
            ->willReturn($strategy);

        $this->provider->expects($this->never())
            ->method('getRate');

        $result = $this->sut->calculate($transaction);

        $this->assertSame('0.1', $result);
    }

    public function testCalculateForNonEURTransactionWithExchangeRateZero(): void
    {
        $transaction = new Transaction('1', '1', 'PLN');
        $strategy = new class () implements CalculationStrategyInterface {
            public function calculateCommission(Transaction $transaction): string
            {
                return '0.1';
            }

            public function supports(Transaction $transaction): bool
            {
                return true;
            }
        };

        $this->factory->expects($this->once())
            ->method('create')
            ->with($transaction)
            ->willReturn($strategy);

        $this->provider->expects($this->once())
            ->method('getRate')
            ->with('EUR', 'PLN')
            ->willReturn('0.000');

        $result = $this->sut->calculate($transaction);

        $this->assertSame('0.1', $result);
    }

    public function testCalculateForNonEURTransaction(): void
    {
        $transaction = new Transaction('1', '1', 'PLN');
        $strategy = new class () implements CalculationStrategyInterface {
            public function calculateCommission(Transaction $transaction): string
            {
                return bcmul($transaction->amount, '0.1');
            }

            public function supports(Transaction $transaction): bool
            {
                return true;
            }
        };

        $this->factory->expects($this->once())
            ->method('create')
            ->with($transaction)
            ->willReturn($strategy);

        $this->provider->expects($this->once())
            ->method('getRate')
            ->with('EUR', 'PLN')
            ->willReturn('0.100');

        $result = $this->sut->calculate($transaction);

        $this->assertSame('1', $result);
    }
}
