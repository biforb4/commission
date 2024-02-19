<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\CommissionCalculator\CalculationStrategy;

use App\Service\BinLookup\BinDetailsProvider;
use App\Service\CommissionCalculator\CalculationStrategy\EUCountryStrategy;
use App\Service\CommissionCalculator\Transaction;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EUCountryStrategyTest extends TestCase
{
    protected BinDetailsProvider|MockObject $provider;
    private EUCountryStrategy $sut;

    protected function setUp(): void
    {
        $this->provider = $this->createMock(BinDetailsProvider::class);

        $this->sut = new EUCountryStrategy($this->provider);
    }

    public function testSupports(): void
    {
        $transaction = new Transaction('1', '1', 'EUR');
        $this->provider->expects($this->once())
            ->method('getAlpha2Country')
            ->with('1')
            ->willReturn('AT');

        $this->assertTrue($this->sut->supports($transaction));
    }

    public function testCalculatingCommission(): void
    {
        $transaction = new Transaction('1', '1', 'EUR');

        $this->assertSame('0.01', $this->sut->calculateCommission($transaction));
    }
}
