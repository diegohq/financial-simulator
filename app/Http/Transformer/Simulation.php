<?php

namespace App\Http\Transformer;

use App\Services\Applications\Application;

class Simulation
{
    /**
     * Transform simulation for user
     *
     * @param Application $application
     * @return array
     */
    public function transform(Application $application): array
    {
        return [
            'gross_amount' => $this->format($application->grossAmount()),
            'discounts' => $this->format($application->discounts()),
            'final_amount' => $this->format($application->finalAmount()),
        ];
    }

    /**
     * Format number
     *
     * @param float $number
     * @return string
     */
    private function format(float $number)
    {
        return floatval(
            number_format(
                $number,
                2,
                '.',
                ''
            )
        );
    }

}
