<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature_product extends Model
{
    use HasFactory;
    protected $table = 'feature_product';
    protected $primaryKey = 'id_feature';
    public $timestamps = false;

    protected $fillable = [
        'id_feature', 'id_product', 'id_feature_value'
    ];
}
