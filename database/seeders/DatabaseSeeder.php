<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        $admin = User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $johnny = User::factory()->create([
            'name'  => 'Johnny Jonathan',
            'email' => 'johnny@setlist.test',
        ]);

        foreach ([$admin, $johnny] as $user) {
            $mixes = \App\Models\Mix::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);

            foreach ($mixes as $mix) {
                \App\Models\Comment::factory()->count(2)->create([
                    'user_id' => $johnny->id,
                    'mix_id'  => $mix->id,
                ]);
            }
        }
    }
}
