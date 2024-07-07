<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public $timestamps = true;

    protected $fillable = [
        'comment_name',
        'comment_email',
        'comment_message',
        'comment_status',
        'blog_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
