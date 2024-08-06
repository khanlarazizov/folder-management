<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $folder = Folder::pluck('id')->toArray();
        $currency = ['AZN', 'USD'];
        $type = ['Partnyorluq', 'Xidmət', 'Alqı-satqı'];
        $shopping = ['Biz alırıq', 'Biz satırıq'];
        return [
            'name' => fake()->name,
            'date' => fake()->date('Y-m-d'),
            'folder_id' => fake()->randomElement($folder),
            'type' => fake()->randomElement($type),
            'shopping' => fake()->randomElement($shopping),
            'other_side_name' => fake()->name,
            'other_side_type' => fake()->name,
            'price' => rand(100, 1000),
            'currency' => fake()->randomElement($currency),
            'tag' => fake()->word . ',',
            'file' => 'file.pdf',
        ];
    }
}
