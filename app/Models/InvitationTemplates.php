<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationTemplates extends Model
{
    protected $table = 'invitation_templates';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'content',
        'type',
        'conference_id',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
