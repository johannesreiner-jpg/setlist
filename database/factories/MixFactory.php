<?php

namespace Database\Factories;

use App\Models\Mix;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mix>
 */
class MixFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    $orte = ['Basilar', 'Sisyphos', 'Fusion', 'Dekmantel', 'Nachtdigital', 'Garbicz'];
    $anlass = ['Nightshift at ', 'Closing set at ', 'Warm-up at ', 'Live from '];

    return [
        'user_id'     => \App\Models\User::factory(),
        'title'       => fake()->randomElement($anlass) . fake()->randomElement($orte),
        'genre'       => fake()->randomElement(['Techno', 'House', 'Drum & Bass', 'Minimal', 'Breakbeat']),
        'bpm'         => fake()->numberBetween(118, 150),
        'description' => fake()->sentence(14),
    ];
}
}
