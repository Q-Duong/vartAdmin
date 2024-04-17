<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceType extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'conference_type_name'
    ];
    protected $primaryKey = 'conference_type_id';
    protected $table = 'conference_type';

    public function conference()
    {
        $this->hasMany('App\Models\Conference');
    }
}
