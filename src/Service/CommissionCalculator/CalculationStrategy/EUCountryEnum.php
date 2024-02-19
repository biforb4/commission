<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator\CalculationStrategy;

enum EUCountryEnum
{
    case AT;
    case BE;
    case BG;
    case CY;
    case CZ;
    case DE;
    case DK;
    case EE;
    case ES;
    case FI;
    case FR;
    case GR;
    case HR;
    case HU;
    case IE;
    case IT;
    case LT;
    case LU;
    case LV;
    case MT;
    case NL;
    case PO;
    case PT;
    case RO;
    case SE;
    case SI;
    case SK;

    public static function isEuCountry(string $countryCode): bool
    {
        $cases = self::cases();

        return in_array(strtoupper($countryCode), array_column($cases, 'name'), true);
    }
}
