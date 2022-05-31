<?php

namespace App\Services\Discounts;

abstract class Discount
{
    /**
     * Calculate discount amount
     *
     * @param float $initialAmount
     * @param float $finalAmount
     * @param int $days
     * @return float
     */
    abstract public function calculate(
        float $initialAmount,
        float $finalAmount,
        int $days
    ): float;

    /**
     * Calculate the investment yield
     *
     * @param float $initialAmount
     * @param float $finalAmount
     * @return float
     */
    protected function yield(float $initialAmount, float $finalAmount): float
    {
        return $finalAmount - $initialAmount;
    }
}
