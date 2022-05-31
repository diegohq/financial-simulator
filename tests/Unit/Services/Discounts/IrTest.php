<?php

namespace Tests\Unit\Services\Discounts;

use App\Services\Discounts\Ir;
use Tests\TestCase;

class IrTest extends TestCase
{
    /** @dataProvider discountValueProvider */
    public function testDiscountValue(
        float $initialAmount,
        float $finalAmount,
        int $days,
        float $expected
    ): void {
        $service = new Ir();

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
            [1000, 1100, 1, 22.5],
            [1000, 1100, 180, 20],
            [1000, 1100, 450, 17.5],
            [1000, 1100, 600, 17.5],
            [1000, 1100, 1000, 15],
        ];
    }

}
