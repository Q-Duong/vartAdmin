<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $table = 'payments';

  public $timestamps = true;

  protected $fillable = [
    'payment_price',
    'payment_method',
    'payment_image',
    'payment_status',
    'conference_fee_id',
  ];
  
  public function register()
  {
    return $this->hasOne(Register::class);
  }
  public function en_register()
  {
    return $this->hasOne(EnRegister::class);
  }
  public function conferenceFee()
  {
    return $this->belongsTo(ConferenceFee::class);
  }
}
