<?php

namespace App\Services\Applications;

use App\Services\CompoundInterest;
use App\Services\Discounts\Iof;
use App\Services\Discounts\Ir;

/**
 * CDB stands for "Certificado de Depósito Interbancário", which means
 * "Interbank Deposit Certificate". Basically here you lend money to a bank
 * and it refunds you back with some yield.
 */
class Cdb extends Lci
{
    /**
     * Constructor
     *
     * @param CompoundInterest $compoundInterest
     * @param Ir $ir
     * @param Iof $iof
     */
    public function __construct(
        private CompoundInterest $compoundInterest,
        protected Ir $ir,
        protected Iof $iof,
    ) {
        parent::__construct($this->compoundInterest, $iof);
    }

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
        parent::calculateDiscount($initialAmount, $days);

        $this->discounts += $this->ir->calculate(
            $initialAmount,
            $this->grossAmount,
            $days
        );
    }
}
