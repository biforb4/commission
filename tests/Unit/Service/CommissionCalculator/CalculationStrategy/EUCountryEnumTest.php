<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\CommissionCalculator\CalculationStrategy;

use App\Service\CommissionCalculator\CalculationStrategy\EUCountryEnum;
use PHPUnit\Framework\TestCase;

class EUCountryEnumTest extends TestCase
{
    /** @dataProvider countries */
    public function testCheckingIfCountryIsEU($countryCode, $result): void
    {
        $this->assertSame(EUCountryEnum::isEuCountry($countryCode), $result);
    }

    public function countries()
    {
        return [
            'EU' => ['AT', true],
            'EU lowercase' => ['sk', true],
            'Non EU' => ['US', false],
        ];
    }
}
