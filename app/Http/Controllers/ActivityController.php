<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     * タイプと会社名はセレクト型検索、説明はテキスト型検索にしました。
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $companyId = $request->input('company_id');
        $description = $request->input('description');

        $typeOptions = Activity::query()
            ->select('type')
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $companyOptions = Company::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $descriptionOptions = Activity::query()
            ->select('description')
            ->whereNotNull('description')
            ->where('description', '!=', '')
            ->distinct()
            ->orderBy('description')
            ->pluck('description');

        $activities = Activity::query()
            ->with(['company', 'contact', 'deal'])
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->when($description, function ($query, $description) {
                $query->where('description', 'like', '%' . $description . '%');
            })
            ->get();

        return view('dashboard.activity_index', compact(
            'activities',
            'type',
            'companyId',
            'description',
            'typeOptions',
            'companyOptions',
            'descriptionOptions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //会社情報 ログインしてるuser_idのものだけ取得するように修正必要
        $companies = \App\Models\Company::all();
        return view('dashboard.activity_create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //バリデーション
        $validated = $request->validate([
            'company_id'        => 'required|exists:companies,id',
            'contact_id'        => 'nullable|exists:contacts,id',
            'deal_id'           => 'nullable|exists:deals,id',
            'type'              => 'required|string',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'date'              => 'nullable|date',
            'status'            => 'nullable|string',
            'phone_ng'          => 'boolean',
            'last_sales_status' => 'nullable|string',
            'email_notes'       => 'nullable|string',
            'call_notes'        => 'nullable|string',
        ],[
            'company_id.required' => '会社IDは必須です。',
        ]);

            //ログインしているユーザーのIDを追加
            $validated['user_id'] = auth()->id();

            //商談を作成
            \App\Models\Activity::create($validated);
            return redirect()->route('activities.index')->with('success', 'Activity created successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $companies = \App\Models\Company::all();
        $activity = \App\Models\Activity::findOrFail($id);
        return view('dashboard.activity_show', compact('activity', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $companies = \App\Models\Company::all();
        $activity = \App\Models\Activity::findOrFail($id);
        return view('dashboard.activity_edit', compact('activity', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'company_id'        => 'required|exists:companies,id',
            'contact_id'        => 'nullable|exists:contacts,id',
            'deal_id'           => 'nullable|exists:deals,id',
            'type'              => 'required|string',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'date'              => 'nullable|date',
            'status'            => 'nullable|string',
            'phone_ng'          => 'boolean',
            'last_sales_status' => 'nullable|string',
            'email_notes'       => 'nullable|string',
            'call_notes'        => 'nullable|string',
        ]);

        //商談を更新
        $companies = \App\Models\Company::all();
        $activity = \App\Models\Activity::findOrFail($id);
        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $activity = \App\Models\Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
