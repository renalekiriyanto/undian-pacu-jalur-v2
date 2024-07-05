<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function undian(){
        return $this->belongsTo(Lottery::class, 'lottery_id', 'id');
    }

    public function putaran(){
        return $this->belongsTo(Lap::class, 'lap_id', 'id');
    }

    public function name_jalur_kiri(){
        return $this->belongsTo(Canoe::class, 'jalur_kiri', 'id');
    }

    public function name_jalur_kanan(){
        return $this->belongsTo(Canoe::class, 'jalur_kanan', 'id');
    }
}