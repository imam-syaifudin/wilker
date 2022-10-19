<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ["created_at", "updated_at"];

    public function fromPlace(){
        return $this->hasMany(Schedule::class,'from_place_id');
    }
    public function toPlace(){
        return $this->hasMany(Schedule::class,'to_place_id');
    }

    public function fromPlaceRoute(){
        return $this->hasMany(Route::class,'from_place_id');
    }
    public function toPlaceRoute(){
        return $this->hasMany(Route::class,'to_place_id');
    }
}
