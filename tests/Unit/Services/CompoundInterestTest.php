<?php

namespace Tests\Unit\Services;

use App\Services\CompoundInterest;
use Tests\TestCase;

class CompoundInterestTest extends TestCase
{
    /**
     * @dataProvider calculateCompoundInterestsProvider
     */
    public function testCalculateCompoundInterests(
        float $initialAmount,
        int   $days,
        float $annualInterest,
        float $finalAmount
    ): void {
        $service = new CompoundInterest();
        $this->assertEqualsWithDelta(
            $finalAmount,
            $service->calculate(
                $initialAmount,
                $days,
                $annualInterest
            ),
            0.01
        );
    }

    public function calculateCompoundInterestsProvider(): array
    {
        return [
            [1000, 360, 0.1, 1100],
            [2000, 360, 0.1, 2200],
            [1000, 720, 0.2, 1440],
            [2000, 720, 0.2, 2880],
        ];
    }

}
