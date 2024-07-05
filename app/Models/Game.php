<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function name_jalur_kiri(){
        return $this->belongsTo(Canoe::class, 'jalur_kiri', 'id');
    }

    public function name_jalur_kanan(){
        return $this->belongsTo(Canoe::class, 'jalur_kanan', 'id');
    }
}