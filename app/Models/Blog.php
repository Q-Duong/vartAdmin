<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'blog_title', 'blog_slug', 'blog_content', 'blog_image', 'blog_category_id'
    ];
    protected $primaryKey = 'blog_id';
    protected $table = 'blog';

    public function blog_category()
    {
        return $this->belongsTo('App\Models\BlogCategory', 'blog_category_id');
    }
    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
