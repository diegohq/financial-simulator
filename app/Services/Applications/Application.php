<?php

namespace App\Services\Applications;

abstract class Application
{
    protected float $grossAmount;
    protected float $discounts = 0;

    /**
     * Calculate final amount
     *
     * @param float $initialAmount
     * @param float $annualInterest
     * @param int $days
     * @return float
     */
    abstract public function calculate(
        float $initialAmount,
        int $days,
        float $annualInterest,
    ): float;

    /**
     * Return final amount
     *
     * @return float
     */
    public function finalAmount(): float
    {
        return $this->grossAmount - $this->discounts;
    }

    /**
     * Return gross amount
     *
     * @return float
     */
    public function grossAmount(): float
    {
        return $this->grossAmount;
    }

    /**
     * Return discounts sum
     *
     * @return float
     */
    public function discounts(): float
    {
        return $this->discounts;
    }

}
