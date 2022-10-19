<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fromPlace(){
        return $this->belongsTo(Place::class,'from_place_id');
    }
    public function toPlace(){
        return $this->belongsTo(Place::class,'to_place_id');
    }

    public function route(){
        return $this->hasMany(Route::class);
    }
}
