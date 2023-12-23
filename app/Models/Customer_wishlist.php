<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_wishlist extends Model
{
    use HasFactory;
    protected $table = 'customer_wishlists';
    public $timestamps = false;

    protected $fillable = [
        'id', 'id_customer', 'id_product'
    ];
}
