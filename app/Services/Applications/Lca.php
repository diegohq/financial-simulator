<?php

namespace App\Services\Applications;

/**
 * LCI stands for "Letras de Crédito do Agronegócio", which means "bills of
 * agribusiness credit" and it is issued by a financial institution. It is
 * tax-exempt and invests only in the agribusiness market.
 */
class Lca extends Lci
{
    /**
     * Calculate all discounts
     *
     * @param float $initialAmount
     * @param int $days
     * @return void
     */
    protected function calculateDiscount(
        float $initialAmount,
        int $days
    ): void {
        $this->discounts = $this->iof->calculate(
            $initialAmount,
            $this->grossAmount,
            $days
        );
    }
}
