<?php

namespace App\Services\Discounts;

/**
 * IOF stands for "Imposto sobre Operações Financeiras", which means "financial
 * transaction tax". This tax is only applied for investment time less than 30
 * days and it decreases day by day. It starts at 96% to 0%.
 */
class Iof extends Discount
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
        if($days == 1) return 0.96;
        if($days == 2) return 0.93;
        if($days == 3) return 0.9;
        if($days == 4) return 0.86;
        if($days == 5) return 0.83;
        if($days == 6) return 0.8;
        if($days == 7) return 0.76;
        if($days == 8) return 0.73;
        if($days == 9) return 0.7;
        if($days == 10) return 0.66;
        if($days == 11) return 0.63;
        if($days == 12) return 0.6;
        if($days == 13) return 0.56;
        if($days == 14) return 0.53;
        if($days == 15) return 0.5;
        if($days == 16) return 0.46;
        if($days == 17) return 0.43;
        if($days == 18) return 0.4;
        if($days == 19) return 0.36;
        if($days == 20) return 0.33;
        if($days == 21) return 0.3;
        if($days == 22) return 0.26;
        if($days == 23) return 0.23;
        if($days == 24) return 0.2;
        if($days == 25) return 0.16;
        if($days == 26) return 0.13;
        if($days == 27) return 0.1;
        if($days == 28) return 0.06;
        if($days == 29) return 0.03;

        return 0;
    }


}
