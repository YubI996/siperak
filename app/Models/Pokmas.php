<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokmas extends Model
{
    use HasFactory;

    public function Rts()
    {
        return $this->BelongsTo(Rt::class, 'rt_id');
    }

    public function Menus()
    {
        return $this->HasMany(Menu::class);
    }

    public function Deliveries()
    {
        return $this->hasManyThrough(Delivery::class, Menu::class);
    }
}
