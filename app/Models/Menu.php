<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;


    public function Pokmas()
    {
        return $this->BelongsTo('Pokmas', 'pokmas');
    }

    public function Delivery()
    {
        return $this->HasMany('Delivery');
    }
}
