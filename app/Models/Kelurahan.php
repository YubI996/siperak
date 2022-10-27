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
        return $this->BelongsTo('Kecamatan', 'kecamatan_id');
    }

    public function Rt()
    {
        return $this->HasMany('Rt');
    }
}
