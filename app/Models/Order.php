<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // Define the relationship between Order and OrderItem (One-to-Many)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define the relationship between Order and User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

