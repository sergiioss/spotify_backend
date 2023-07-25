<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistSongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('playlist_songs')->insert([
            'playlist_songs' => 'Pop Music',
            'photo' => 'https://previews.123rf.com/images/stuartphoto/stuartphoto1607/stuartphoto160700760/61305854-pop-songs-significado-populares-de-m%C3%BAsica-y-sonido.jpg',
            'songs' => 1
        ]);

        DB::table('playlist_songs')->insert([
            'playlist_songs' => 'Rap',
            'photo' => 'https://cdn.w600.comps.canstockphoto.es/el-p%C3%B3ster-del-concierto-de-rap-clipart-vectorial_csp38569751.jpg',
            'songs' => 2
        ]);
    }
}
