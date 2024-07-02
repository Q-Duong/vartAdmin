<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceType extends Model
{
    protected $table = 'conference_types';

    public $timestamps = true;

    protected $fillable = [
        'conference_type_name'
    ];

    public function conference()
    {
        $this->hasMany(Conference::class);
    }
}
