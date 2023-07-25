<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artists')->insert([
            'name' => 'Dua',
            'surnames' => 'Lipa',
            'nationality' => 'Britanica Albanesa',
            'photo' => 'https://lumiere-a.akamaihd.net/v1/images/dua_lipa_portada_5_bf1628a4.jpeg?region=15,0,1956,1100&width=768'
        ]);

        DB::table('artists')->insert([
            'name' => 'Bad Bunny',
            'surnames' => 'Martínez Ocasio',
            'nationality' => 'Estadounidense',
            'photo' => 'https://images.ecestaticos.com/KDZ9knew1FQqm1IOcmIV7oubq7Q=/0x45:1189x674/557x418/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2Fd27%2Fbba%2F3a8%2Fd27bba3a8af9ab17991362798f0f7488.jpg'
        ]);

        DB::table('artists')->insert([
            'name' => 'Justin Bieber',
            'surnames' => 'Drew Bieber',
            'nationality' => 'Canadiense',
            'photo' => 'https://okdiario.com/img/2019/12/17/justin-bieber-pierde-mucho-peso-en-pocos-meses-655x368.jpg'
        ]);
    }
}
