<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'id_category', 'id_parent', 'active', 'show_home', 'level', 'name', 'position', 'url', 'description'
    ];
}
