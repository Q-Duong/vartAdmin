<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnRegister extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_id', 'payment_id', 'en_register_code', 'en_register_title', 'en_register_firstname', 'en_register_lastname', 'en_register_gender', 'en_register_phone', 'en_register_email', 'en_register_nation', 'en_register_work_unit', 'en_register_type',
    ];
    protected $primaryKey = 'en_register_id';
    protected $table = 'en_register';

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }
}
