<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attribute_image extends Model
{
    use HasFactory;
    protected $table = 'product_attribute_image';
    protected $primaryKey = 'id_product_attribute';
    public $timestamps = false;

    protected $fillable = [
        'id_product_attribute', 'id_image'
    ];
}
