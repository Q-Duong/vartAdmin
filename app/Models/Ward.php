<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'type',
        'province_id',
        'sort_order'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
