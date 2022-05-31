<?php

namespace App\Services;

class CompoundInterest
{
    /**
     * Calculate compound interest
     *
     * @param float $initialAmount
     * @param int $days
     * @param float $annualInterest
     * @return float
     */
    public function calculate(
        float $initialAmount,
        int   $days,
        float $annualInterest
    ): float {
        return $initialAmount * pow(
            1 + $this->annualToDaily($annualInterest),
            $days
        );
    }

    /**
     * Convert annual interest to daily interest
     *
     * @param float $annualInterest
     * @return float
     */
    private function annualToDaily(float $annualInterest): float
    {
        return ((1 + $annualInterest) ** (1/360)) - 1;
    }

}
