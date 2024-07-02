<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceFee extends Model
{
    protected $table = 'conference_fees';

    public $timestamps = true;

    protected $fillable = [
        'conference_fee_code',
        'conference_fee_price',
        'conference_fee_title',
        'conference_fee_date',
        'conference_fee_content',
        'conference_fee_desc',
        'conference_fee_type',
        'conference_fee_status',
        'mail_type',
        'conference_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function payment()
    {
        $this->hasMany(Payment::class);
    }
}
