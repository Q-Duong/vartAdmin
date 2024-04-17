<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vart extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'vart_title', 'vart_title_en', 'vart_slug', 'vart_image'
    ];
    protected $primaryKey = 'vart_id';
    protected $table = 'vart';

    public function vart_content()
    {
        $this->hasMany('App\Models\VartContent');
    }
}
