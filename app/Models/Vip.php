<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $table = 'vips';

    public $timestamps = true;

    protected $fillable = [
        'vip_code',
        'vip_name',
        'vip_gender',
        'vip_date',
        'vip_month',
        'vip_year',
        'vip_phone',
        'vip_email',
        'vip_degree',
        'vip_work_unit',
        'vip_receiving_address',
        'vip_cme',
        'conference_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
