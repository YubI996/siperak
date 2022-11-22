<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rt extends Model
{
    use HasFactory;

    public function Kelurahans()
    {
        return $this->BelongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function Users()
    {
        return $this->HasMany(User::class);
    }

    public function Pokmases()
    {
        return $this->HasMany(Pokmas::class);
    }

    public function Recipients()
    {
        return $this->HasMany(Recipient::class);
    }
}
