<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrtta extends Model
{
    protected $table = 'hrttas';

    public $timestamps = true;
        
    protected $fillable = [
        'hrtta_title',
        'hrtta_title_en',
        'hrtta_slug',
        'hrtta_image',
        'hrtta_text',
        'hrtta_text_en'
    ];
}
