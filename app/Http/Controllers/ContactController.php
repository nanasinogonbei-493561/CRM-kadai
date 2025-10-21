<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index() {
        $contacts = \App\Models\Contact::all();
        // dd($contacts);
        return view('dashboard.contact_index', compact('contacts'));
    }

    public function create(){
        return view('dashboard.contact_create');
    }


    public function store(Request $request){
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            'user_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);
    }

    public function show($id){
        $contact = \App\Models\Contact::findOrFail($id);
        return view('dashboard.contact_show', compact('contact'));
    }

    public function edit($id){
        $contact = \App\Models\Contact::findOrFail($id);
        return view('dashboard.contact_edit', compact('contact'));
    }

    public function update(Request $request, $id){
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            'user_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        //会社を更新
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id){
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
