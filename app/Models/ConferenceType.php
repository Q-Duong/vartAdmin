<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceType extends Model
{
    protected $table = 'conference_types';

    public $timestamps = true;

    protected $fillable = [
        'conference_type_name',
        'conference_type_name_en'
    ];

    public function conference()
    {
        $this->hasMany(Conference::class);
    }
}
