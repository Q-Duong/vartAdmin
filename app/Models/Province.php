<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'province_name', 'province_type', 'sort'
    ];
    protected $primaryKey = 'province_id';
    protected $table = 'province';
}
