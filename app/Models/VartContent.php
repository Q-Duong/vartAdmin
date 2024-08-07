<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VartContent extends Model
{
    protected $table = 'vart_contents';

    public $timestamps = true;

    protected $fillable = [
        'vart_content_themes',
        'vart_content_title',
        'vart_content_title_en',
        'vart_content_text',
        'vart_content_text_en',
        'vart_content_image',
        'vart_id'
    ];

    public function vart()
    {
        return $this->belongsTo(Vart::class);
    }
}
