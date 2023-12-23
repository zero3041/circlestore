<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attribute';
    protected $primaryKey = 'id_attribute';
    public $timestamps = false;

    protected $fillable = [
        'id_attribute_group', 'position', 'color','name'
    ];

    public function saveValueAttr($request)
    {
        $res = $this->create([
            'id_attribute_group' => $request->id_attribute_group,
            'color' => $request->color,
            'position' => 1,
            'name' => $request->value
        ]);
        return $res;
    }
}
