<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_order', 'id_carrier', 'id_customer','payment', 'total_discount', 'total_shipping', 'total_price', 'total_tax','total_price_tax', 'address', 'phone_number', 'status', 'check', 'tracking_number'
    ];
}
