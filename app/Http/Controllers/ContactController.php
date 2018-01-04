<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // use Illuminate\Support\Facades\Mail;

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:255',
        ]);
        $contact = new Contact([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message')
        ]);
        if ($contact->save()) {
            $contact_array = new ContactMail($contact);
            Mail::to('sergio.nader@gmail.com')->send($contact_array);
            return redirect()->route('docs.author.index')->with('info-success', 'Thank you, ' . $contact->name . ', for contacting us. The message has been sent and we will reply as soon as possible');
        }

        return redirect()->route('docs.author.contact')->with('info-danger', 'Could not save the record.');
    }
}
