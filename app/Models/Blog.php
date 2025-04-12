<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    public $timestamps = true;

    protected $fillable = [
        'blog_title',
        'blog_title_en',
        'blog_slug',
        'blog_text',
        'blog_text_en',
        'blog_image',
        'blog_category_id'
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
