<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_group extends Model
{
    use HasFactory;
    protected $table = 'attribute_group';
    protected $primaryKey = 'id_attribute_group';

    protected $fillable = [
        'is_color', 'group_type', 'position','name'
    ];


    public function attributeLang()
    {
        return $this->hasMany('App\Models\Attribute_group_lang','id_attribute_group');
    }

    public function saveAttr($request)
    {
        $is_color = $request->type == 'color' ? 1 : 0;
        $res = $this->create([
            'is_color' => $is_color,
            'group_type' => $request->type,
            'position' => 1,
            'name' => $request->name
        ]);
        return $res;
    }
}
