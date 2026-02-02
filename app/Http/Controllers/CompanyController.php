<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(Request $request){
        $name = $request->input('name');

        $nameOptions = Company::query()
            ->select('name')
            ->whereNotNull('name')
            ->distinct()
            ->orderBy('name')
            ->pluck('name');

        $companies = Company::query()
            ->when($name, function ($query, $name) {
                $query->where('name', $name);
            })
            ->get();

        return view('dashboard.company_index', compact('companies', 'name', 'nameOptions'));
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

    public function search(Request $request)
    {
        // 入力からの会社名を取得
        $name = $request->input('name');

        // クエリビルダのインスタンスを作成
        $query = Company::query();

        try {
            // 名前フィルタがあれば、クエリに追加
            if ($name) {
                $query->where('name', 'LIKE', "%$name%");
            }

            // クエリを実行して結果を取得
            $companies = $query->get();

            // 結果が0件でも空配列で返す
            return response()->json($companies);

        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            return response()->json(['error' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }
}
