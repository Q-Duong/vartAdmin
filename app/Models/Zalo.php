<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zalo extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'access_token', 'refresh_token'
    ];
    protected $primaryKey = 'zalo_id';
 	protected $table = 'tbl_zalo';
}
