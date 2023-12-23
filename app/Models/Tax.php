<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'tax';
    protected $primaryKey = 'id_tax';
    public $timestamps = false;

    protected $fillable = [
        'id_tax', 'name', 'value'
    ];
}
