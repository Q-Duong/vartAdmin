<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceCategory extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_category_name', 'conference_category_name_en', 'conference_category_slug', 'conference_category_image'
    ];
    protected $primaryKey = 'conference_category_id';
    protected $table = 'conference_category';

    public function conference()
    {
        $this->hasMany('App\Models\Conference');
    }
}
