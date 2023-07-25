<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('albums')->insert([
            'name' => 'Deezer Sessions',
            'artist_id' => 1,
            'release_date' => '11/04/2019',
            'photo' => 'https://ecsmedia.pl/cdn-cgi/image/format=webp,width=544,height=544,/c/deezer-sessions-b-iext125709468.jpg'
        ]);

        DB::table('albums')->insert([
            'name' => 'Future nostalgia',
            'artist_id' => 1,
            'release_date' => '27/03/2020',
            'photo' => 'https://webrewired.com/wp-content/uploads/2020/06/5d40cc8d15cac155809c1218444b21e8-1.jpg'
        ]);

        DB::table('albums')->insert([
            'name' => 'YHLQMDLG',
            'artist_id' => 2,
            'release_date' => '29/02/2020',
            'photo' => 'https://consequence.net/wp-content/uploads/2020/02/bad-bunny-Yo-Hago-Lo-Que-Me-Da-La-Gana-YHLQMDLG-album-cover-artowrk.jpg?resize=1031,580'
        ]);

        DB::table('albums')->insert([
            'name' => 'Un verano sin ti',
            'artist_id' => 2,
            'release_date' => '06/05/2022',
            'photo' => 'https://crazyminds.es/wp-content/uploads/unveranosinti.jpg'
        ]);

        DB::table('albums')->insert([
            'name' => 'The Best',
            'artist_id' => 3,
            'release_date' => '27/02/2019',
            'photo' => 'https://static.wikia.nocookie.net/justin-bieber/images/b/b0/The_Best.jpg/revision/latest?cb=20220719230138&path-prefix=es'
        ]);

        DB::table('albums')->insert([
            'name' => 'Changes',
            'artist_id' => 3,
            'release_date' => '14/02/2020',
            'photo' => 'https://cloudfront-eu-central-1.images.arcpublishing.com/prisaradiolos40/GJ2NQ52WZVLBFCCO4PEVTZZAHE.jpg'
        ]);
    }
}


