<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Invitation;

class InvitationController extends Controller
{
    public function index()
    {
        $conferences = Conference::select('id', 'conference_title', 'conference_code')->orderBy('id', 'DESC')->get();
        return view('pages.admin.invitation.list', compact('conferences'));
    }

    public function indexDetails($code)
    {
        $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('conference_code', $code);
        $getInvitation = Invitation::where('conference_id', $conference->id)
        ->orderBy('id', 'DESC')
        ->paginate(10);
        return view('pages.admin.invitation.index', compact('getInvitation', 'conference'));
    }
}
