<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function create()
    {
        return view('pages.contacts.index');
    }

    // Lưu thông tin liên hệ
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|max:20',
            'message' => 'required'
        ]);

        Contact::create($request->all());

        return redirect()->back()
            ->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}
