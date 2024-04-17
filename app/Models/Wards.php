<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'wards_name', 'district_id'
    ];
    protected $primaryKey = 'wards_id';
    protected $table = 'wards';

    public function receiver()
    {
        return $this->hasMany('App\Models\Receiver');
    }
    public function delivery()
    {
        return $this->hasMany('App\Models\Delivery');
    }
}
