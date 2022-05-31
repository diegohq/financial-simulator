<?php

namespace App\Services\Discounts;

/**
 * IR stands for "Imposto de Renda", which is the brazilian "income tax". This
 * tax decreases as the investment time increases. It starts at 22,5% and goes
 * down to 15%.
 */
class Ir extends Discount
{
    /**
     * @inheritDoc
     */
    public function calculate(
        float $initialAmount,
        float $finalAmount,
        int $days
    ): float {
        $yield = $this->yield($initialAmount, $finalAmount);
        if($yield <= 0) {
            return 0;
        }

        return $yield * $this->rate($days);
    }

    /**
     * Calculate IR rate
     *
     * @param int $days
     * @return float
     */
    private function rate(int $days): float
    {
        if($days < 180) {
            return 0.225;
        }

        if($days < 360) {
            return 0.2;
        }

        if($days < 720) {
            return 0.175;
        }

        return 0.15;
    }


}
