<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function typeHotel(){
        return $this->belongsTo(TypeHotel::class, "type_hotel_id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function product(){
        return $this->hasMany(Product::class, "hotel_id");
    }
}
