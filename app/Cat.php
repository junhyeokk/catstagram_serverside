<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cat extends Model
{
    use SoftDeletes;
    protected $table = 'cats';
    protected $fillable = [
        'name',
        'neutralization',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function spots() {
        return $this->hasMany('App\Spot', 'cat_id');
    }

    public function articles() {
        return $this->hasMany('App\Article', 'cat_id');
    }
}
