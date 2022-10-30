<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Users()
    {
        return $this->BelongsTo(User::class, 'actor');
    }

    public function Receptions()
    {
        return $this->BelongsTo(Reception::class, 'reception');
    }
}
