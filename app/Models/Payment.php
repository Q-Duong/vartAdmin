<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public $timestamps = true; //set time to false
  protected $fillable = [
    'conference_fee_id', 'payment_price', 'payment_method', 'payment_image', 'payment_status'
  ];
  protected $primaryKey = 'payment_id';
  protected $table = 'payment';

  public function register()
  {
    return $this->hasOne('App\Models\Register');
  }
  public function en_register()
  {
    return $this->hasOne('App\Models\EnRegister');
  }
  public function conference_fee()
  {
    return $this->belongsTo('App\Models\ConferenceFee', 'conference_fee_id');
  }
}
