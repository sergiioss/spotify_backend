<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    public function artists()
    {
        return $this->belongsTo(Artists::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Albums::class);
    }
}
