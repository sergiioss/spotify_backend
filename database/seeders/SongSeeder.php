<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('songs')->insert([
            'name' => 'Levitating',
            'artist_id' => 1,
            'album_id' => 2,
            'photo' => 'https://pics.filmaffinity.com/Dua_Lipa_feat_DaBaby_Levitating_Music_Video-845430788-large.jpg'
        ]);

        DB::table('songs')->insert([
            'name' => "Don't Start Now",
            'artist_id' => 1,
            'album_id' => 2,
            'photo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fe/DSNDL.png'
        ]);

        DB::table('songs')->insert([
            'name' => 'Bichiyal',
            'artist_id' => 2,
            'album_id' => 3,
            'photo' => 'https://i.ytimg.com/vi/Udxl17LVHYA/maxresdefault.jpg'
        ]);

        DB::table('songs')->insert([
            'name' => 'Safaera',
            'artist_id' => 2,
            'album_id' => 3,
            'photo' => 'https://s3.amazonaws.com/prod-wp-tvc/wp-content/uploads/2022/03/principal_bad-bunny-safaera-.png'
        ]);

        DB::table('songs')->insert([
            'name' => 'No Brainer',
            'artist_id' => 3,
            'album_id' => 5,
            'photo' => 'https://i1.sndcdn.com/artworks-000382651197-5xohvl-t500x500.jpg'
        ]);

        DB::table('songs')->insert([
            'name' => 'Forever',
            'artist_id' => 3,
            'album_id' => 6,
            'photo' => 'https://cloudfront-eu-central-1.images.arcpublishing.com/prisaradiolos40/GJ2NQ52WZVLBFCCO4PEVTZZAHE.jpg'
        ]);
    }
}
