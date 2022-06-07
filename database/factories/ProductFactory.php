<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "Product - " . $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['children', 'food', 'clothes']),
        ];
    }
}
