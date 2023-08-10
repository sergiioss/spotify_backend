<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class
        ]);

        $this->call([
            ArtistSeeder::class
        ]);

        $this->call([
            AlbumSeeder::class
        ]);
        
        $this->call([
            SongSeeder::class
        ]);

        $this->call([
            UserSeeder::class
        ]);
        
        $this->call([
            RoleUserSeeder::class
        ]);
        
        $this->call([
            PlaylistSeeder::class
        ]);
        
        $this->call([
            PlaylistSongsSeeder::class
        ]);
    }
}
