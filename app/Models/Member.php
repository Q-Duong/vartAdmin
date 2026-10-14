<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    public $timestamps = true;

    protected $fillable = [
        'member_code',
        'member_title',
        'member_national_id',
        'member_first_name',
        'member_last_name',
        'member_full_name',
        'member_gender',
        'member_date',
        'member_month',
        'member_year',
        'member_phone',
        'member_email',
        'member_degree',
        'member_place_of_birth',
        'member_country',
        'member_nation',
        'member_work_unit',
        'member_object_group',
        'member_degree_number',
        'member_degree_date',
        'member_graduation_year',
        'member_image',
        'member_image_card',
        'province_id',
        'ward_id',
        'address_detail',
        'member_full_address',
    ];

    protected $casts = [
        'member_degree_date' => 'date',
    ];

    public function register()
    {
        $this->hasMany(Register::class);
    }

    public function report()
    {
        $this->hasMany(Report::class);
    }
}
