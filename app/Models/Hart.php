<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hart extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'hart_title', 'hart_slug', 'hart_image'
    ];
    protected $primaryKey = 'hart_id';
    protected $table = 'hart';

    public function hart_content()
    {
        $this->hasMany('App\Models\HartContent');
    }
}
