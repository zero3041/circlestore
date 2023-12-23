<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category_product extends Model
{
    use HasFactory;
    protected $table = 'category_product';
    protected $primaryKey = 'id_category';
    public $timestamps = false;

    protected $fillable = [
        'id_category', 'id_product', 'position'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_product', 'id_category');
    }
}
