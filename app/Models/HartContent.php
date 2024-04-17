<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HartContent extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'hart_content_themes', 'hart_content_title', 'hart_content_text', 'hart_content_image', 'hart_id'
    ];
    protected $primaryKey = 'hart_content_id';
    protected $table = 'hart_content';

    public function hart()
    {
        return $this->belongsTo('App\Models\Hart', 'hart_id');
    }
}
