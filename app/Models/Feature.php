<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'feature';
    protected $primaryKey = 'id_feature';
    public $timestamps = false;

    protected $fillable = [
        'id_feature', 'name'
    ];

    public function saveFeature($request)
    {
        $res = $this->create([
            'name' => $request->name
        ]);
        return $res;
    }
}
