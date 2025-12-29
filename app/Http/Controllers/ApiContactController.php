<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiContactController extends Controller
{
    //
    public function getConctactsByCompnay($companyId){
        $contacts = \App\Models\Contact::where('company_id', $companyId)->get();
        return response()->json($contacts);

    }
}
