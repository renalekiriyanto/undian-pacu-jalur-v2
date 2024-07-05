<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function arena(){
        return $this->belongsTo(Arena::class, 'arena_id', 'id');
    }
}