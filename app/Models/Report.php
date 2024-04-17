<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_id', 'report_name', 'report_gender', 'report_date', 'report_month', 'report_year', 'report_phone', 'report_email', 'report_degree', 'report_place_of_birth', 'report_work_unit', 'report_graduation_year', 'report_image', 'report_image_card', 'report_file', 'report_policy', 'report_status'
    ];
    protected $primaryKey = 'report_id';
    protected $table = 'report';

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
}
