<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use SoftDeletes;
    protected $table = 'spots';
    protected $fillable = [
        'cat_id',
        'x',
        'y',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function cat() {
        return $this->belongsTo('App\Cat', 'cat_id');
    }
}
