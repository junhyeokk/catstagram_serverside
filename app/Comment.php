<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';
    protected $fillable = [
        'article_id',
        'writer',
        'content',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function article() {
        return $this->belongsTo('App\Article', 'article_id');
    }
}
