<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id_product_attribute';
    public $timestamps = false;

    protected $fillable = [
        'id_product', 'id_product_attribute', 'quantity', 'price', 'price_tax', 'default_on', 'width', 'height', 'depth', 'weight'
    ];
}
