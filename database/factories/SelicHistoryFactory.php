<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SelicHistory>
 */
class SelicHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'announced_at' => $this->faker->date,
            'value' => $this->faker->numberBetween(1, 100) / 100,
        ];
    }
}
