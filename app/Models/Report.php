<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    public $timestamps = true;

    protected $fillable = [
        'conference_id',
        'member_id',
        'report_code',
        'report_topics',
        'report_file_title',
        'report_file',
        'report_policy',
        'report_file_background',
        'report_share',
        'report_type',
        'locale',
        'report_suggested_addition',
        'report_reason_rejection',
        'report_status',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
