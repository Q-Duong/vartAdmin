<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'district_name', 'province_id'
    ];
    protected $primaryKey = 'district_id';
 	protected $table = 'district';

    public function receiver(){
        return $this->hasMany('App\Models\Receiver');
    }
    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}
