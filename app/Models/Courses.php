<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    public $timestamps = true;
    protected $fillable = [
    	'courses_themes','courses_title','courses_slug','courses_content','courses_programs','courses_image'
    ];
    protected $primaryKey = 'courses_id';
 	protected $table = 'courses';


     public function courses_content(){
        $this->hasMany('App\Models\CoursesContent');
    }
}
