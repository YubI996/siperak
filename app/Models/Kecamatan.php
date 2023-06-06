<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelurahan;

class Kecamatan extends Model
{
    use HasFactory;

    public function Kelurahans()
    {
        return $this->HasMany(Kelurahan::class);
    }

    public function Rts()
    {
        return $this->hasManyThrough(Rt::class, Kelurahan::class, 'kecamatan_id', 'kelurahan_id', 'id', 'id');
    }
}
