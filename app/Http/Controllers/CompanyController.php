<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(){

        //会社一覧を取得してビューに渡す
        $companies = \App\Models\Company::all();
        //dd($companies);
        return view('dashboard.company_index', compact('companies'));
    }

    public function create(){
        return view('dashboard.company_create');
    }

    public function store(Request $request){
        //バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'industry' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        //会社を作成
        $company = \App\Models\Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show($id){
        $company = \App\Models\Company::findOrFail($id);
        return view('dashboard.company_show', compact('company'));
    }

    public function edit($id){
        $company = \App\Models\Company::findOrFail($id);
        return view('dashboard.company_edit', compact('company'));
    }

    public function update(Request $request, $id){
        //バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'industry' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        //会社を更新
        $company = \App\Models\Company::findOrFail($id);
        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id){
        $company = \App\Models\Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
