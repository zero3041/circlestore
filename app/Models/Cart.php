<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'items',
        'total_items',
        'total_price',
    ];

    // Chuyển đổi trường 'items' từ JSON sang mảng khi lấy dữ liệu từ database
    protected $casts = [
        'items' => 'array',
//        'total_price' => 'decimal:2'
    ];

    // Định nghĩa mối quan hệ One-to-One với mô hình User
    public function user()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id_customer');
    }
}
