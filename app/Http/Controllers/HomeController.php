<?php

namespace App\Http\Controllers;

use function Laravel\Prompts\search;
use Illuminate\Http\Request;

class HomeController extends Controller 
{
    // 検索したら検索画面に偏移するようにしました。
    public function index() {
        $companies = DB::table('companies')
            ->whereLike('name', '%%')
            ->get();
        
        $contacts = DB::table('contacts')
            ->whereLike('name' , '%%')
            ->get();

        $deals = DB::table('deals')
            ->whereLike('name' , '%%')
            ->get();

        $activities = DB::table('activities')
            ->whereLike('name' , '%%')
            ->get();


        return view('dashboard');
    }
}
