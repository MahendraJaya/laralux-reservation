<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsToMany(Product::class, "product_transaction", "transaction_id", "product_id")
        ->withPivot("quantity", "subtotal");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }
    
}
