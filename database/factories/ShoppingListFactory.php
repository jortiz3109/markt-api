<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingList>
 */
class ShoppingListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'total' => fake()->numberBetween(),
        ];
    }

    public function paid(): Factory
    {
        return $this->state( function (array $attributes) {
            return [
                'paid_at' => Carbon::now()
            ];
        });
    }
}
