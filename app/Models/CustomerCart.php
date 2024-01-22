<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerCart extends Model
{
    use HasFactory;
    protected $table = 'shoppingcart';
    protected $fillable = ['identifier', 'instance','content'];


}
