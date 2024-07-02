<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conferences';

    public $timestamps = true;

    protected $fillable = [
        'conference_code',
        'conference_title',
        'conference_title_en',
        'conference_slug',
        'conference_content',
        'conference_content_en',
        'conference_image',
        'conference_image_en',
        'conference_form_type',
        'conference_category_id',
        'conference_type_id',
    ];

    public function conferenceCategory()
    {
        return $this->belongsTo(ConferenceCategory::class);
    }

    public function conferenceType()
    {
        return $this->belongsTo(ConferenceType::class);
    }

    public function conferenceFee()
    {
        $this->hasMany(ConferenceFee::class);
    }

    public function register()
    {
        $this->hasMany(Register::class);
    }

    public function report()
    {
        $this->hasMany(Report::class);
    }
}
