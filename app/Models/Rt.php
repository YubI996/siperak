<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rt extends Model
{
    use HasFactory;

    public function Kelurahan()
    {
        return $this->BelongsTo('Kelurahan', 'kelurahan_id');
    }

    public function User()
    {
        return $this->HasMany('User');
    }

    public function Pokmas()
    {
        return $this->HasMany('Pokmas');
    }

    public function Reception()
    {
        return $this->HasMany('Reception');
    }
}
