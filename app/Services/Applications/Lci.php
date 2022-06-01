<?php

namespace App\Services\Applications;

use App\Services\CompoundInterest;
use App\Services\Discounts\Iof;
use App\Services\Discounts\Ir;

/**
 * LCI stands for "Letras de Crédito Imobiliário", which means "bills of real
 * estate credit" and it is issued by a financial institution. It is tax-exempt
 * and invests only in the real estate market.
 */
class Lci extends Application
{
    /**
     * Constructor
     *
     * @param CompoundInterest $compoundInterest
     * @param Iof $iof
     */
    public function __construct(
        private CompoundInterest $compoundInterest,
        protected Iof $iof,
    ) {}

    /**
     * @inheritDoc
     */
    public function calculate(
        float $initialAmount,
        int $days,
        float $annualInterest,
    ): Application {

        $this->grossAmount = $this->compoundInterest->calculate(
            $initialAmount,
            $days,
            $annualInterest
        );

        $this->calculateDiscount($initialAmount, $days);

        return $this;
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
        $this->discounts = $this->iof->calculate(
            $initialAmount,
            $this->grossAmount,
            $days
        );
    }
}
