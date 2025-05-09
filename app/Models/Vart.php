<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vart extends Model
{
    protected $table = 'varts';

    public $timestamps = true;

    protected $fillable = [
        'vart_title',
        'vart_title_en',
        'vart_slug',
        'vart_image',
        'vart_text',
        'vart_text_en',
    ];
}
