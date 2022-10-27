<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public function Menu()
    {
        return $this->BelongsTo('Menu', 'menu');
    }

    public function Pengantar()
    {
        return $this->BelongsTo('User', 'pengantar');
    }

    public function Pokmas()
    {
        return $this->BelongsTo('Pokmas', 'pokmas');
    }

    public function Penerima()
    {
        return $this->BelongsTo('Reception', 'penerima');
    }
}
