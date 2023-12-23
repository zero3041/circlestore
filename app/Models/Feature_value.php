<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature_value extends Model
{
    use HasFactory;
    protected $table = 'feature_value';
    protected $primaryKey = 'id_feature_value';
    public $timestamps = false;

    protected $fillable = [
        'id_feature_value', 'id_feature', 'value'
    ];

    public function saveValueFeature($request)
    {
        $res = $this->create([
            'id_feature' => $request->id_feature,
            'value' => $request->value
        ]);
        return $res;
    }
}
