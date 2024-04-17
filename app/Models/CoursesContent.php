<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesContent extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'courses_id', 'courses_content_title', 'courses_content_text', 'courses_content_image', 'courses_content_type'
    ];
    protected $primaryKey = 'courses_content_id';
    protected $table = 'courses_content';

    public function courses()
    {
        return $this->belongsTo('App\Models\Courses', 'courses_id');
    }
}
