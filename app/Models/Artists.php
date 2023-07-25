<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    use HasFactory;

    public function songs()
    {
        return $this->hasMany(Songs::class);
    }
}
