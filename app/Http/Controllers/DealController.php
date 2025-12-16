<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $deals = \App\Models\Deal::all();
        // dd($deals);
        return view('dashboard.deal_index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //会社情報 ログインしてるuser_idのものだけ取得するように修正必要
        $companies = \App\Models\Company::all();
        return view('dashboard.contact_create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            'title' => 'required|string|max:255',
            'amount' => 'required|integer',
            'status' => 'nullable|string',
            'date' => 'nullable|date',
            'probability' => 'nullable|percentage',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ],[
            'company_id.required' => '会社IDは必須です。',
        ]);

            //ログインしているユーザーのIDを追加
            $validated['user_id'] = auth()->id();

            //商談を作成
            \App\Models\deal::create($validated);
            return redirect()->route('deal.index')->with('success', 'Deal created successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $deal = \App\Models\Deal::findOrFail($id);
        return view('dashboard.deal_show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $deal = \App\Models\Deal::findOrFail($id);
        return view('dashboard.deal_edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //バリデーション
        $validated = $request->validate([
            // 'company_id' => 'required|string',
            'title' => 'required|string|max:255',
            'amount' => 'required|integer',
            'status' => 'nullable|string',
            'date' => 'nullable|date',
            'probability' => 'nullable|percentage',
            'description' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        //商談を更新
        $deal = \App\Models\Deal::findOrFail($id);
        $deal->update($validated);

        return redirect()->route('deal.index')->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $deal = \App\Models\Contact::findOrFail($id);
        $deal->delete();

        return redirect()->route('deal.index')->with('success', 'Deal deleted successfully.');
    }
}
