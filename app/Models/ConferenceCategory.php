<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceCategory extends Model
{
    protected $table = 'conference_categories';

    public $timestamps = true;

    protected $fillable = [
        'conference_category_name',
        'conference_category_name_en',
        'conference_category_slug',
        'conference_category_image'
    ];

    public function conference()
    {
        $this->hasMany(Conference::class);
    }
}
