<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $table = 'articles';
    protected $fillable = [
        'cat_id',
        'writer',
        'content',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function cat() {
        return $this->belongsTo('App\Cat', 'cat_id');
    }

    public function images() {
        return $this->hasMany('App\Image', 'article_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'article_id');
    }
}
