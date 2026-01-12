<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $activities = \App\Models\Activity::with(['company', 'contact', 'deal'])->get();
        return view('dashboard.activity_index', compact('activities'));
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
            'company_id' => 'required|string',
            'contact_id' => 'required|string',
            'deal_id' => 'required|string',
            'type' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'status' => 'nullable|string',
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
            'company_id' => 'required|string',
            'contact_id' => 'required|string',
            'deal_id' => 'required|string',
            'type' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'status' => 'nullable|string',
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
