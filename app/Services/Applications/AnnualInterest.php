<?php

namespace App\Services\Applications;

use App\Models\SelicHistory;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AnnualInterest
{
    /**
     * Return the annual interest processed
     *
     * @param float $annualInterest
     * @param string $baseTax
     * @return float
     */
    public function interest(
        float $annualInterest,
        string $baseTax
    ): float {
        return $annualInterest * $this->baseTax($baseTax);
    }

    private function baseTax(string $baseTax)
    {
        if($baseTax == "raw") {
            return 1;
        }

        $selic = SelicHistory::query()
            ->latest('announced_at')
            ->firstOrFail()
            ->value;

        if($baseTax == "selic") {
            return $selic;
        }

        if($baseTax == "cdi") {
            return $selic - 0.001;
        }

        throw new UnprocessableEntityHttpException(
            $baseTax ." does not exist"
        );
    }
}
