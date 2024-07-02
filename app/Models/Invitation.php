<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = 'invitations';

    public $timestamps = true; //set time to false

    protected $fillable = [
        'details',
        'conference_id',
        'conference_type_id',
    ];
}
