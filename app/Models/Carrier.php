<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $table = 'carrier';
    protected $primaryKey = 'id_carrier';
    public $timestamps = false;

    protected $fillable = [
        'id_carrier', 'name', 'active', 'url'
    ];
}
