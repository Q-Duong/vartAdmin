<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'comment_name', 'comment_email', 'comment_message', 'blog_id', 'comment_status'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'comment';

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }
}
