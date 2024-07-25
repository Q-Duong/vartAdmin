<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationLetter extends Model
{
    protected $table = 'invitation_letters';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'title_en',
        'type',
        'path',
        'conference_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
