<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public $timestamps = true;

    protected $fillable = [
        'district_name',
        'province_id'
    ];

    public function receiver()
    {
        return $this->hasMany('App\Models\Receiver');
    }
    public function delivery()
    {
        return $this->hasMany('App\Models\Delivery');
    }
}
