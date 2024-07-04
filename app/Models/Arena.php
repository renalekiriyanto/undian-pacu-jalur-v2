<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}