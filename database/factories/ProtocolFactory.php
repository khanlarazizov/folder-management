<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Protocol>
 */
class ProtocolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currency = ['AZN', 'USD'];;
        $contracts = Contract::pluck('id')->toArray();
        return [
            'name' => fake()->name,
            'date' => fake()->date('Y-m-d'),
            'contract_id' => fake()->randomElement($contracts),
            'other_side_name' => fake()->name,
            'price' => rand(100, 1000),
            'currency' => fake()->randomElement($currency),
            'tag' => fake()->word,
            'file' => 'file.pdf',
        ];
    }
}
