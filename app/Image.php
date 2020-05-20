<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $table = 'images';
    protected $fillable = [
        'article_id',
        'image_url',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function article() {
        return $this->belongsTo('App\Article', 'article_id');
    }
}
