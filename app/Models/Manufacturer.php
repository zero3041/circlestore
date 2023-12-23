<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $table = 'manufacturer';
    protected $primaryKey = 'id_manufacturer';
    public $timestamps = false;

    protected $fillable = [
        'id_manufacturer', 'name', 'active', 'url'
    ];
}
