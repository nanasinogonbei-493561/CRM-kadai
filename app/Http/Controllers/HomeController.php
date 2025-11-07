<?php

namespace App\Http\Controllers;

use function Laravel\Prompts\search;
use Illuminate\Http\Request;

class HomeController extends Controller 
{
    public function index() {
        $companies = DB::table('companies')
            ->whereLike('name', '%%')
            ->get();
        
        $contacts = DB::table('contacts')
            ->whereLike('name' , '%%')
            ->get();
        return view('dashboard');
    }
}
