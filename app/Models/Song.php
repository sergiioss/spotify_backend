<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    public function artists()
    {
        return $this->belongsTo(Artist::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Albums::class);
    }

    public function songs_heard()
    {
        return $this->belongsTo(Songs_heard::class);
    }
}
