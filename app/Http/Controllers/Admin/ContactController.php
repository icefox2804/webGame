<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị danh sách liên hệ
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    // Hiển thị chi tiết liên hệ
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    // Xóa liên hệ (soft delete)
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')
            ->with('success', 'Đã chuyển liên hệ vào thùng rác!');
    }

    // Hiển thị danh sách liên hệ đã xóa
    public function trash()
    {
        $contacts = Contact::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.contacts.trash', compact('contacts'));
    }

    // Khôi phục liên hệ
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('admin.contacts.trash')
            ->with('success', 'Đã khôi phục liên hệ thành công!');
    }

    // Xóa vĩnh viễn liên hệ
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return redirect()->route('admin.contacts.trash')
            ->with('success', 'Đã xóa vĩnh viễn liên hệ!');
    }
}
