<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Click>
 */
class ClickFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip' => fake()->ipv4(),
            'operating_system' => fake()->randomElement(['Windows', 'Mac', 'Linux', 'Android', 'iOS']),
            'browser' => fake()->randomElement(['Chrome', 'Firefox', 'Edge', 'Safari', 'Opera', 'Brave']),
            'device' => fake()->text(20),
        ];
    }
}
