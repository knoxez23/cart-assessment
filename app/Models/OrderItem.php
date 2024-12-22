<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    //relationship between OrderItem and Order (Many-to-One)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // elationship between OrderItem and Product (Many-to-One)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

