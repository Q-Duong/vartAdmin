<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_code', 'conference_title', 'conference_title_en','conference_slug', 'conference_content', 'conference_content_en','conference_image', 'conference_image_en', 'conference_category_id', 'conference_type_id', 'conference_form_type'
    ];
    protected $primaryKey = 'conference_id';
    protected $table = 'conference';

    public function conference_category()
    {
        return $this->belongsTo('App\Models\ConferenceCategory', 'conference_category_id');
    }

    public function conference_type()
    {
        return $this->belongsTo('App\Models\ConferenceType', 'conference_type_id');
    }

    public function conference_fee()
    {
        $this->hasMany('App\Models\ConferenceFee');
    }

    public function register()
    {
        $this->hasMany('App\Models\Register');
    }

    public function report()
    {
        $this->hasMany('App\Models\Report');
    }

    public function album()
    {
        $this->hasMany('App\Models\Album');
    }
}
