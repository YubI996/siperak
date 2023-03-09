<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';
    protected $fillable = [
        'penerima',
        'menu',
        'pengantar',
        'status',
        'dok',
        'pengaduan',
        'karbo_consmd',
        'l_hwn_consmd',
        'l_nbt_consmd',
        'sayur_consmd',
        'buah_consmd'
    ];
    public function Menus()
    {
        return $this->BelongsTo(Menu::class, 'menu');
    }

    public function Pengantar()
    {
        return $this->BelongsTo(User::class, 'pengantar');
    }

    public function Pokmases()
    {
        return $this->BelongsTo(Pokmas::class, 'pokmas');
    }

    public function Penerima()
    {
        return $this->BelongsTo(Recipient::class, 'penerima');
    }
}
