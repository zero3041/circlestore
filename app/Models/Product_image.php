<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Product_image extends Model
{
    use HasFactory;
    protected $table = 'product_image';
    protected $primaryKey = 'id_image';
    public $timestamps = false;

    protected $fillable = [
        'id_image', 'id_product', 'cover', 'url'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_image');
    }
}
