<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    public $timestamps = false;

    protected $fillable = [
        'topic_title',
        'topic_title_en',
    ];

    public function report()
    {
        $this->hasMany(Report::class);
    }

    public function en_report()
    {
        $this->hasMany(EnReport::class);
    }
}
