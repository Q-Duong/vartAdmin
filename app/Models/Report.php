<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    public $timestamps = true;

    protected $fillable = [
        'conference_id',
        'report_code',
        'report_name',
        'report_gender',
        'report_date',
        'report_month',
        'report_year',
        'report_phone',
        'report_email',
        'report_degree',
        'report_place_of_birth',
        'report_work_unit',
        'report_graduation_year',
        'report_topics',
        'report_file_title',
        'report_image',
        'report_image_card',
        'report_file',
        'report_policy',
        'report_file_background',
        'report_share',
        'report_suggested_addition',
        'report_reason_rejection',
        'report_status',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
