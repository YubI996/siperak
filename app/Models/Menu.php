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

    // public function Deliveries()
    // {
    //     return $this->HasMany(Delivery::class);
    // }

    public function Recipients()
    {
        return $this->BelongsToMany(Menus::class, 'deliveries')->withPivot('pengantar', 'status', 'pengaduan', 'dok', 'karbo_consmd', 'l_hwn_consmd', 'l_nbt_consmd', 'sayur_consmd', 'buah_consmd')->withTimestamps();
    }
}
