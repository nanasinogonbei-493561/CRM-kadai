<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(Request $request) {
        $companyId = $request->input('company_id');

        $companies = Company::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $contacts = Contact::query()
            ->when($companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->get();

        return view('dashboard.contact_index', compact('contacts', 'companies', 'companyId'));
    }

    public function create(){
        //会社情報をプルダウンで選択出来るように修正
        $companies = \App\Models\Company::all();
        return view('dashboard.contact_create', compact('companies'));
    }


    public function store(Request $request){
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ],[
            'company_id.required' => '会社IDは必須です。',
        ]);

        //ログインしているユーザーのIDを追加

        $validated['user_id'] = auth()->id();


        // dd($validated);
        //連絡先を作成
        \App\Models\Contact::create($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact created successfull');
    }

    public function show($id){
        $companies = \App\Models\Company::all();
        $contact = \App\Models\Contact::findOrFail($id);
        return view('dashboard.contact_show', compact('contact', 'companies'));
    }

    public function edit($id){
        $companies = \App\Models\Company::all();
        $contact = \App\Models\Contact::findOrFail($id);
        return view('dashboard.contact_edit', compact('contact', 'companies'));
    }

    public function update(Request $request, $id){
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            // 'user_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        //会社を更新
        $companies = \App\Models\Company::all();
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id){
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function search(Request $request)
    {
        // 入力からの会社名を取得
        $CompanyName = $request->input('CompanyName');

        // クエリビルダのインスタンスを作成
        $query = Company::query();

        try {
            // 名前フィルタがあれば、クエリに追加
            if ($CompanyName) {
                $query->where('CompanyName', 'LIKE', "%$CompanyName%");
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
