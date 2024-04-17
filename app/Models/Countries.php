<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'country_code', 'country_name'
    ];
    protected $primaryKey = 'country_id';
    protected $table = 'countries';
}
