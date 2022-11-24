<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;
use App\Models\Rt;

class Kelurahan extends Model
{
    use HasFactory;

    public function Kecamatan()
    {
        return $this->BelongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function Rts()
    {
        return $this->HasMany(Rt::class);
    }
}
