<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterFee extends Model
{
    protected $table = 'register_fees';

    public $timestamps = true;

    protected $fillable = [
        'register_id',
        'conference_fee_id',
        'price',
    ];
}
