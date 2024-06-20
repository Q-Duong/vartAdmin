<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_id', 'album_path'
    ];
    protected $table = 'albums';

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
}
