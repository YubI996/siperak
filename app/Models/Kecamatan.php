<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelurahan;

class Kecamatan extends Model
{
    use HasFactory;

    public function Kelurahan()
    {
        return $this->HasMany('Kelurahan');
    }
}
