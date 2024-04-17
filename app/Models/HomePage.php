<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'home_page_title', 'home_page_content', 'home_page_image'
    ];
    protected $primaryKey = 'home_page_id';
    protected $table = 'home_page';
}
