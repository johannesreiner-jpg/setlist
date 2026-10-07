<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $comments = [
            'The transition around twelve minutes is ridiculous. What is that second track?',
            'Been waiting for this one, thanks for uploading.',
            'Tracklist?',
            'That breakdown near the end got me.',
            'Was there that night. This brings it all back.',
            'The mixing is so clean. How long have you been doing this?',
            'Second half is stronger than the first, no offence.',
            'This is going straight into my rotation.',
            'ID on the last track please, I am begging.',
            'Played this twice on the drive home already.',
            'Great energy throughout. The pacing is what makes it.',
            'Not usually my thing but this won me over.',
            'Had to rewind the first ten minutes.',
            'Sounds like you were having fun. It comes through.',
            'More of this please.',
            'Quality as always.',
        ];

        return [
            'user_id' => \App\Models\User::factory(),
            'mix_id'  => \App\Models\Mix::factory(),
            'body'    => fake()->randomElement($comments),
        ];
    }
}
