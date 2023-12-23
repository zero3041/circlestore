<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;
    protected $table = 'cms';
    protected $primaryKey = 'id_cms';

    protected $fillable = [
        'id_cms', 'position', 'active', 'title', 'description', 'show_home'
    ];
}
