<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    public function playlist_songs()
    {
        return $this->hasMany(Playlist_songs::class);
    }
}
