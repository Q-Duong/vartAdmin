<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyLetter extends Model
{
    protected $table = 'verify_letters';

    public $timestamps = true;

    protected $fillable = [
        'password',
        'conference_id',
        'conference_code'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
