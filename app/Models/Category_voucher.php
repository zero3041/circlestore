<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_voucher extends Model
{
    use HasFactory;
    protected $table = 'category_voucher';
    protected $primaryKey = 'voucher_id';
    public $timestamps = false;

    protected $fillable = [
        'voucher_id', 'category_id', 'position'
    ];

    public function vouchers()
    {
        return $this->hasMany(Product::class, 'id', 'voucher_id');
    }
}
