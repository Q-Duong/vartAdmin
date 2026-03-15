<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'sort_order',
    ];

    public function ward()
    {
        $this->hasMany(Ward::class);
    }
}
