<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'academic_title', 'academic_title_en'
    ];
    protected $primaryKey = 'academic_id';
    protected $table = 'academic';
}
