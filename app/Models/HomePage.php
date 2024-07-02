<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table = 'home_pages';

    public $timestamps = true;

    protected $fillable = [
        'home_page_title',
        'home_page_content',
        'home_page_image'
    ];
}
