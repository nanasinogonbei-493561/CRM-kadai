<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $companyId = $request->input('company_id');
        $status = $request->input('status');

        $titleOptions = Deal::query()
            ->select('title')
            ->whereNotNull('title')
            ->distinct()
            ->orderBy('title')
            ->pluck('title');

        $companyOptions = Company::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $statusOptions = Deal::query()
            ->select('status')
            ->whereNotNull('status')
            ->where('status', '!=', '')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        $deals = Deal::query()
            ->with(['company', 'contact'])
            ->when($title, function ($query, $title) {
                $query->where('title', $title);
            })
            ->when($companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->get();

        return view('dashboard.deal_index', compact(
            'deals',
            'title',
            'companyId',
            'status',
            'titleOptions',
            'companyOptions',
            'statusOptions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //会社情報を取得。
        $companies = \App\Models\Company::all();
        return view('dashboard.deal_create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'company_id'  => 'required|exists:companies,id',
            'contact_id'  => 'nullable|exists:contacts,id',
            'title'       => 'required|string|max:255',
            'status'      => 'nullable|in:商談中,成約,検討,断り済,失注',
            'deal_status' => 'nullable|in:成約,検討,商談設定中',
            'date'        => 'nullable|date',
            'probability' => 'nullable|integer|between:0,100',
            'description' => 'nullable|string',
            'notes'       => 'nullable|string',
        ],[
            'company_id.required' => '会社IDは必須です。',
        ]);

            //ログインしているユーザーのIDを追加
            $validated['user_id'] = auth()->id();

            //商談を作成
            \App\Models\Deal::create($validated);
            return redirect()->route('deals.index')->with('success', 'Deal created successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $companies = \App\Models\Company::all();
        $deal = \App\Models\Deal::findOrFail($id);
        return view('dashboard.deal_show', compact('deal', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $companies = \App\Models\Company::all();
        $deal = \App\Models\Deal::findOrFail($id);
        return view('dashboard.deal_edit', compact('deal', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //バリデーション
        $validated = $request->validate([
            'contact_id'  => 'nullable|exists:contacts,id',
            'title'       => 'required|string|max:255',
            'status'      => 'nullable|in:商談中,成約,検討,断り済,失注',
            'deal_status' => 'nullable|in:成約,検討,商談設定中',
            'date'        => 'nullable|date',
            'probability' => 'nullable|integer|between:0,100',
            'description' => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        //商談を更新
        $companies = \App\Models\Company::all();
        $deal = \App\Models\Deal::findOrFail($id);
        $deal->update($validated);

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $deal = \App\Models\Deal::findOrFail($id);
        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully.');
    }
}
