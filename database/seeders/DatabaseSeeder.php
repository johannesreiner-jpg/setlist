<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $johnny = User::factory()->create([
            'name' => 'Johnny Jonathan',
            'email' => 'johnny@setlist.test',
        ]);

        $mixes = \App\Models\Mix::factory()
            ->count(6)
            ->create([
                'user_id' => $johnny->id,
            ]);
            
        foreach ($mixes as $mix) {
            \App\Models\Comment::factory()->count(2)->create([
                'user_id' => $johnny->id,
                'mix_id'  => $mix->id,
            ]);
        }
    }
}
