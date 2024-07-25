<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function edit()
    {
        $contact = Contact::find(1);
        return view('pages.admin.contact.edit', compact('contact'));
    }
    public function update(Request $request)
    {
        $contact = Contact::find(1);
        $contact->contact = $request->contact;
        $contact->map = $request->map;
        $contact->save();
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
    public function save_info(Request $request)
    {
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];

        $contact->save();
        return redirect()->back()->with('success', 'Cập nhật thông tin website thành công');
    }
}
