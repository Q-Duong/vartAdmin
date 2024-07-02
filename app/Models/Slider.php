<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    public $timestamps = true;

    protected $fillable = [
        'slider_name',
        'slider_image',
        'slider_status',
        'slider_desc'
    ];
}
