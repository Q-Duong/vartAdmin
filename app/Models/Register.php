<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\RegisterBuilder;

class Register extends Model
{
    protected $table = 'registers';

    public $timestamps = true;

    protected $fillable = [
        'register_code',
        'register_policy',
        'more_options',
        'register_cme_type',
        'locale',
        'conference_id',
        'member_id',
        'payment_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
    public function fees()
    {
        return $this->belongsToMany(ConferenceFee::class, 'register_fees', 'register_id', 'conference_fee_id')
            ->withPivot('price') // Lấy thêm cột giá trong bảng trung gian
            ->withTimestamps();
    }
    public function newEloquentBuilder($query): RegisterBuilder
    {
        return new RegisterBuilder($query);
    }
}
