<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hart extends Model
{
    protected $table = 'harts';

    public $timestamps = true;
        
    protected $fillable = [
        'hart_title',
        'hart_title_en',
        'hart_slug',
        'hart_image',
        'hart_text',
        'hart_text_en'
    ];
}
