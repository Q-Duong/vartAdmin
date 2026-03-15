<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nvart extends Model
{
    protected $table = 'nvarts';

    public $timestamps = true;

    protected $fillable = [
        'nvart_title',
        'nvart_title_en',
        'nvart_slug',
        'nvart_image',
        'nvart_text',
        'nvart_text_en',
    ];
}
