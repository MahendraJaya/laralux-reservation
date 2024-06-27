<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function facilities(){
        return $this->hasMany(Facilities::class, "product_id");
    }

    public function typeProduct(){
        return $this->belongsTo(TypeProduct::class, "type_product_id");
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class, "hotel_id");
    }

    public function transaction(){
        return $this->belongsToMany(Transaction::class, "product_transaction", "product_id", "transaction_id");
    }
    

}
