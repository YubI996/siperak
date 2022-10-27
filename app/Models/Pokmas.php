<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokmas extends Model
{
    use HasFactory;

    public function Rt()
    {
        return $this->BelongsTo('Rt', 'rt_id');
    }

    public function Menu()
    {
        return $this->HasMany('Menu');
    }

    public function Delivery()
    {
        return $this->HasMany('Delivery');
    }
}
