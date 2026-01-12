<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDealController extends Controller
{
    //
    public function getDealsByCompany($companyId) {
        $contacts = \App\Models\Deal::where('company_id', $companyId)->get();
        return response()->json($deals);
    }
}
