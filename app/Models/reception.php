<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reception extends Model
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
    ['nama', 'nik', 'foto_penerima', 'no_hp', 'jenkel', 'alamat', 'pekerjaan', 'penyakit', 'rt', 'foto_ktp', 'foto_kk',
    'foto_rumah', 'status_rumah', 'long', 'lat'];

    protected $guarded = ['id'];
}
