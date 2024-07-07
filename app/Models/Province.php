<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    public $timestamps = false;

    protected $fillable = [
        'province_name',
        'province_type',
        'sort',
    ];
}
