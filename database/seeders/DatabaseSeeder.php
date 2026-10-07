<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Mix;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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

        $demoSets = [
            ['genre' => 'Drum & Bass', 'bpm' => 155, 'audio' => 'dnb-155.mp3',    'cover' => 'demo-cover-1.jpg'],
            ['genre' => 'Hardgroove Techno', 'bpm' => 140, 'audio' => 'techno-140.mp3', 'cover' => 'demo-cover-2.jpg'],
            ['genre' => 'Groove House', 'bpm' => 133, 'audio' => 'house-133.mp3',  'cover' => 'demo-cover-3.jpg'],
        ];

        foreach ([$admin, $johnny] as $user) {
            $other = $user->is($admin) ? $johnny : $admin;

            foreach ($demoSets as $set) {
                $mix = Mix::factory()->create([
                    'user_id'    => $user->id,
                    'genre'      => $set['genre'],
                    'bpm'        => $set['bpm'],
                    'audio_path' => $this->copyDemoFile($set['audio'], 'mixes'),
                    'image_path' => $this->copyDemoFile($set['cover'], 'covers'),
                ]);

                Comment::factory()->count(2)->create([
                    'user_id' => $other->id,
                    'mix_id'  => $mix->id,
                ]);
            }
        }
    }

    /**
     * Copy one demo file from database/seeders/demo into the public disk
     * and return the path that gets stored on the mix.
     */
    private function copyDemoFile(string $file, string $folder): string
    {
        $target = $folder . '/' . $file;

        Storage::disk('public')->put(
            $target,
            file_get_contents(database_path('seeders/demo/' . $file))
        );

        return $target;
    }
}