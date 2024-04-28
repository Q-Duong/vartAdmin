<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VartContent extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'vart_content_themes', 'vart_content_title', 'vart_content_title_en', 'vart_content_text', 'vart_content_text_en', 'vart_content_image', 'vart_content_image_en', 'vart_id'
    ];
    protected $primaryKey = 'vart_content_id';
    protected $table = 'vart_content';

    public function vart()
    {
        return $this->belongsTo('App\Models\Vart', 'vart_id');
    }
}
