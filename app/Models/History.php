<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->BelongsTo('User', 'actor');
    }

    public function Reception()
    {
        return $this->BelongsTo('Reception', 'reception');
    }
}
