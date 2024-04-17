<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceFee extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_fee_code', 'conference_id', 'conference_fee_price', 'conference_fee_title', 'conference_fee_date', 'conference_fee_content', 'conference_fee_desc', 'conference_fee_type','conference_fee_status', 'mail_type'
    ];
    protected $primaryKey = 'conference_fee_id';
    protected $table = 'conference_fee';

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }

    public function payment()
    {
        $this->hasMany('App\Models\Payment');
    }
}
