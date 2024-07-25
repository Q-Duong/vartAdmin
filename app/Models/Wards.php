<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    protected $table = 'wards';

    public $timestamps = true;

    protected $fillable = [
        'wards_name',
        'district_id'
    ];
}
