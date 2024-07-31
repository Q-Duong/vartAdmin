<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnReport extends Model
{
    protected $table = 'en_reports';

    public $timestamps = true;

    protected $fillable = [
        'conference_id',
        'en_report_code',
        'en_report_firstname',
        'en_report_lastname',
        'en_report_title',
        'en_report_date',
        'en_report_month',
        'en_report_year',
        'en_report_email',
        'en_report_profession',
        'en_report_organization',
        'en_report_department',
        'en_report_nationality',
        'en_report_topics',
        'en_report_file',
        'en_report_file_title',
        'en_report_share',
        'en_report_status'
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
