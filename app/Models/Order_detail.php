<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $primaryKey = 'id_order_detail';
    public $timestamps = false;
    protected $fillable = [
        'id_order_detail', 'id_order', 'id_product','id_product_attribute', 'product_quantity', 'product_name'
    ];
}
