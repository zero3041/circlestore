<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_image;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_product', 'id_category', 'quantity','cost' ,'price', 'price_tax', 'price_sale', 'id_manufacturer', 'show_price', 'on_sale', 'id_tax', 'active', 'name', 'description_short', 'description', 'hot'
    ];

    public function images()
    {
        return $this->hasMany(Product_image::class, 'id_product', 'id_product');
    }
}
