<?php

namespace App\Services\Applications;

use App\Services\CompoundInterest;

/**
 * This class is used to calculate simple compound interest
 */
class Raw extends Application
{
    /**
     * Constructor
     *
     * @param CompoundInterest $compoundInterest
     */
    public function __construct(private CompoundInterest $compoundInterest) {}

    /**
     * @inheritDoc
     */
    public function calculate(
        float $initialAmount,
        int $days,
        float $annualInterest
    ): Application {
        $this->grossAmount = $this->compoundInterest->calculate(
            $initialAmount,
            $days,
            $annualInterest
        );

        return $this;
    }
}
