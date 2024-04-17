<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'blog_category_name', 'blog_category_slug', 'blog_category_image'
    ];
    protected $primaryKey = 'blog_category_id';
    protected $table = 'blog_category';

    public function blog()
    {
        $this->hasMany('App\Models\Blog');
    }
}
