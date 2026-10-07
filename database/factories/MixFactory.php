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
        $places = ['Basilar', 'Sisyphos', 'Fusion', 'Dekmantel', 'Nachtdigital', 'Garbicz'];
        $occasions = ['Nightshift at ', 'Closing set at ', 'Warm-up at ', 'Live from '];

        $descriptions = [
            'Recorded live off the mixer, no edits afterwards. The first twenty minutes are slow on purpose.',
            'Two hours into the night and the floor finally opened up. This is the stretch where it clicked.',
            'A closing set, so most of the heavy stuff was already gone. Mostly older records I have been carrying around for years.',
            'Warm-up slot. The job is to fill the room without giving away the night, which is harder than it sounds.',
            'Open air at sunrise. Different energy than a club, much more patient.',
            'Mostly vinyl, a few digital tracks where I could not find the press. One mix near the end is rough and I kept it in.',
            'Half of this is unreleased material from friends, the rest is what I have been playing all year.',
            'Second time playing this room. Better than the first, mainly because I stopped rushing.',
            'Late slot on a long night. Took it slower than usual and it worked out.',
            'Straight to a field recorder, so you can hear the room a little. I left that in.',
        ];
        
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => fake()->randomElement($occasions) . fake()->randomElement($places),
            'genre' => fake()->randomElement(\App\Models\Mix::GENRES),
            'bpm' => fake()->numberBetween(118, 150),
            'description' => fake()->randomElement($descriptions),
        ];
    }
}
