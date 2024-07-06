<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arena_id', 'id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'lottery_id', 'id');
    }
}
