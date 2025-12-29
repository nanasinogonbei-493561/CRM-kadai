<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiContactController extends Controller
{
    //
    public function getContactsByCompany($companyId) {
        $contacts = \App\Models\Contact::where('company_id');
        return response() -> json($contacts);
    }
}
