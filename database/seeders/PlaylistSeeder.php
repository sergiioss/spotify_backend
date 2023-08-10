<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('playlist')->insert([
            'name' => 'Rap',
            'user_id' => 1,
        ]);

        DB::table('playlist')->insert([
            'name' => 'Pop Music',
            'user_id' => 1,
        ]);

        DB::table('playlist')->insert([
            'name' => 'Bakala',
            'user_id' => 2,
        ]);
    }
}
