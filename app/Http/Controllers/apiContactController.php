<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiContactController extends Controller
{
    //
    public function getContactsByCompany($companyId) {
        $contacts = \App\Models\Contact::where('company_id', $companyId)->get();
        return response()->json($contacts);
    }
}
