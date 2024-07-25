<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnRegister extends Model
{
    protected $table = 'en_registers';

    public $timestamps = true;

    protected $fillable = [
        'en_register_code',
        'en_register_title',
        'en_register_firstname',
        'en_register_lastname',
        'en_register_gender',
        'en_register_phone',
        'en_register_email',
        'en_register_nation',
        'en_register_work_unit',
        'en_register_type',
        'conference_id',
        'payment_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
