<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;
    protected $table = 'flashsale';
    protected $fillable = ['product_id', 'discount_price', 'end_date'];
    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','product_id');
    }
}
