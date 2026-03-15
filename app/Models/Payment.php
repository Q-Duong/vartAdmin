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
    'transaction_code',
    'payment_date',
    'note'
  ];
  
  public function register()
  {
    return $this->hasOne(Register::class);
  }
}
