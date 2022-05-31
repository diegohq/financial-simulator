<?php

namespace Tests\Unit\Services\Discounts;

use App\Services\Discounts\Iof;
use Tests\TestCase;

class IofTest extends TestCase
{
    /** @dataProvider discountValueProvider */
    public function testDiscountValue(
        float $initialAmount,
        float $finalAmount,
        int $days,
        float $expected
    ): void {
        $service = new Iof();

        $this->assertEqualsWithDelta(
            $expected,
            $service->calculate(
                $initialAmount,
                $finalAmount,
                $days
            ),
            0.01
        );
    }

    public function discountValueProvider()
    {
        return [
            [1000, 999, 1, 0],
            [1000, 1000, 1, 0],
            [1000, 1100, 1, 96],
            [1000, 1100, 2, 93],
            [1000, 1100, 12, 60],
            [1000, 1100, 20, 33],
            [1000, 1100, 29, 3],
            [1000, 1100, 30, 0],
            [1000, 1100, 600, 0],
            [1000, 1100, 1000, 0],
        ];
    }
}
