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

    protected $guarded = ['id'];

    public function Rt()
    {
        return $this->BelongsTo('Rt', 'rt');
    }

    public function Delivery()
    {
        return $this->HasMany('Delivery', 'penerima');
    }

    public function History()
    {
        return $this->HasMany('History', 'reception');
    }
}
