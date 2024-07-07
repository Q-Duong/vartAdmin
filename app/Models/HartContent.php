<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HartContent extends Model
{
    protected $table = 'hart_contents';

    public $timestamps = true;

    protected $fillable = [
        'hart_content_themes',
        'hart_content_title',
        'hart_content_text',
        'hart_content_image',
        'hart_id',
    ];

    public function hart()
    {
        return $this->belongsTo(Hart::class);
    }
}
