<?php

namespace App\Http\Controllers;

use function Laravel\Prompts\search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller 
{
    public function search(Request $request) {
        $searchKeyword = $request->input('keyword');

        // dd($searchKeyword);
        $companies = DB::table('companies')
            ->whereLike('name', '%'.$searchKeyword.'%')
            ->get();
        
        $contacts = DB::table('contacts')
            ->whereLike('name' , '%'.$searchKeyword.'%')
            ->get();
        return view('dashboard/search_list', compact('companies', 'contacts'));
    }
}
