<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_id', 'payment_id', 'register_code', 'register_name', 'register_title', 'register_gender', 'register_date', 'register_month', 'register_year', 'register_phone', 'register_email', 'register_degree', 'register_place_of_birth', 'register_nation', 'register_work_unit', 'register_type', 'register_object_group', 'register_graduation_year', 'register_image', 'register_image_card', 'register_receiving_address', 'register_policy'
    ];
    protected $primaryKey = 'register_id';
    protected $table = 'register';

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }
}
