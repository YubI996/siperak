<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;


    public function Pokmases()
    {
        return $this->BelongsTo(Pokmas::class, 'pokmas');
    }

    public function Deliveries()
    {
        return $this->HasMany(Delivery::class);
    }
}
