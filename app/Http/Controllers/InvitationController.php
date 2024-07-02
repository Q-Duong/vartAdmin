<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {
        $getInvitation = Invitation::orderby('id', 'asc')->get();
        return view('pages.admin.invitation.index', compact('getInvitation'));
    }
}
