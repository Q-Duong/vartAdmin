<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hart extends Model
{
    protected $table = 'harts';

    public $timestamps = true;

    protected $fillable = [
        'hart_title',
        'hart_slug',
        'hart_image'
    ];

    public function hartContent()
    {
        $this->hasMany(HartContent::class);
    }
}
