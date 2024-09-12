<?php

namespace App\Models;

use App\Builders\RegisterBuilder;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

    public $timestamps = true;

    protected $fillable = [
        'register_code',
        'register_name',
        'register_title',
        'register_gender',
        'register_date',
        'register_month',
        'register_year',
        'register_phone',
        'register_email',
        'register_degree',
        'register_place_of_birth',
        'register_nation',
        'register_work_unit',
        'register_type',
        'register_object_group',
        'register_graduation_year',
        'register_image',
        'register_image_card',
        'register_receiving_address',
        'register_policy',
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
    public function newEloquentBuilder($query): RegisterBuilder
    {
        return new RegisterBuilder($query);
    }
}
