<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    ['nama', 'bd', 'nik', 'foto_penerima', 'no_hp', 'jenkel', 'alamat', 'pekerjaan', 'penyakit', 'rt', 'foto_ktp', 'foto_kk',
    'foto_rumah', 'status_rumah', 'long', 'lat'];

    protected $guarded = ['id', 'slug'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Rts()
    {
        return $this->BelongsTo(Rt::class, 'rt');
    }

    public function Deliveries()
    {
        return $this->HasMany(Delivery::class, 'penerima');
    }

    public function Histories()
    {
        return $this->HasMany(History::class, 'reception');
    }
}
