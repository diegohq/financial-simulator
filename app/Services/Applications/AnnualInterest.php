<?php

namespace App\Services\Applications;

use App\Models\SelicHistory;

class AnnualInterest
{
    /**
     * If not informed, SELIC will be used
     *
     * @param float|null $annualInterest
     * @return float
     */
    public function interest(?float $annualInterest = null): float
    {
        if($annualInterest) {
            return $annualInterest;
        }

        return SelicHistory::query()
            ->latest('announced_at')
            ->firstOrFail()
            ->value;
    }
}
