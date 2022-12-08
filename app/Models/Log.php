<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['action', 'actor'];

    protected $guarded = ['id'];


    public function Users()
    {
        return $this->BelongsTo(User::class, 'actor');
    }
}
