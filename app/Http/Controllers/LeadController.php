<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyName = $request->input('company_name');
        $rank        = $request->input('rank');
        $status      = $request->input('status');
        $dealStatus  = $request->input('deal_status');

        $rankOptions = Lead::query()
            ->select('rank')
            ->whereNotNull('rank')
            ->where('rank', '!=', '')
            ->distinct()
            ->orderBy('rank')
            ->pluck('rank');

        $statusOptions = Lead::query()
            ->select('status')
            ->whereNotNull('status')
            ->where('status', '!=', '')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        $dealStatusOptions = ['成約', '検討', '商談設定中'];

        $leads = Lead::query()
            ->with(['company', 'user'])
            ->when($companyName, function ($query, $companyName) {
                $query->where('company_name', 'like', '%' . $companyName . '%');
            })
            ->when($rank, function ($query, $rank) {
                $query->where('rank', $rank);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($dealStatus, function ($query, $dealStatus) {
                $query->where('deal_status', $dealStatus);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.lead_index', compact(
            'leads',
            'companyName',
            'rank',
            'status',
            'dealStatus',
            'rankOptions',
            'statusOptions',
            'dealStatusOptions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.lead_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'      => 'required|string|max:255',
            'contact_name'      => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'phone_ng'          => 'boolean',
            'rank'              => 'nullable|string|max:50',
            'status'            => 'nullable|string|max:50',
            'deal_status'       => 'nullable|in:成約,検討,商談設定中',
            'last_sales_status' => 'nullable|string',
            'email_notes'       => 'nullable|string',
            'call_notes'        => 'nullable|string',
            'notes'             => 'nullable|string',
        ], [
            'company_name.required' => '会社名は必須です。',
        ]);

        $validated['user_id']  = auth()->id();
        $validated['phone_ng'] = $request->boolean('phone_ng');

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'リードを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('dashboard.lead_show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('dashboard.lead_edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name'      => 'required|string|max:255',
            'contact_name'      => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'phone_ng'          => 'boolean',
            'rank'              => 'nullable|string|max:50',
            'status'            => 'nullable|string|max:50',
            'deal_status'       => 'nullable|in:成約,検討,商談設定中',
            'last_sales_status' => 'nullable|string',
            'email_notes'       => 'nullable|string',
            'call_notes'        => 'nullable|string',
            'notes'             => 'nullable|string',
        ], [
            'company_name.required' => '会社名は必須です。',
        ]);

        $validated['phone_ng'] = $request->boolean('phone_ng');

        $lead = Lead::findOrFail($id);
        $lead->update($validated);

        return redirect()->route('leads.index')->with('success', 'リードを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'リードを削除しました。');
    }

    /**
     * Import leads from CSV file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'csv_file.required' => 'CSVファイルを選択してください。',
            'csv_file.mimes'    => 'CSVファイル形式のみアップロード可能です。',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');

        // BOM除去
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        $header = fgetcsv($handle);
        if ($header === false) {
            return redirect()->route('leads.index')->with('error', 'CSVファイルが空です。');
        }

        // ヘッダーを小文字・トリム正規化
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        if (!in_array('company_name', $header)) {
            fclose($handle);
            return redirect()->route('leads.index')->with('error', 'CSVに company_name 列が必要です。');
        }

        $successCount = 0;
        $errorRows    = [];
        $rowNumber    = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            $data = array_combine($header, $row);

            if (empty($data['company_name'])) {
                $errorRows[] = $rowNumber;
                continue;
            }

            $email = $data['email'] ?? null;
            if ($email !== null && $email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorRows[] = $rowNumber;
                continue;
            }

            Lead::create([
                'user_id'           => auth()->id(),
                'company_name'      => $data['company_name'],
                'contact_name'      => $data['contact_name'] ?? null,
                'email'             => $email ?: null,
                'phone'             => $data['phone'] ?? null,
                'phone_ng'          => isset($data['phone_ng']) && in_array($data['phone_ng'], ['1', 'true', 'yes']) ? true : false,
                'rank'              => $data['rank'] ?? null,
                'status'            => $data['status'] ?? null,
                'deal_status'       => $data['deal_status'] ?? null,
                'last_sales_status' => $data['last_sales_status'] ?? null,
                'email_notes'       => $data['email_notes'] ?? null,
                'call_notes'        => $data['call_notes'] ?? null,
                'notes'             => $data['notes'] ?? null,
            ]);

            $successCount++;
        }

        fclose($handle);

        $message = "{$successCount}件のリードをインポートしました。";
        if (!empty($errorRows)) {
            $message .= ' エラー行: ' . implode(', ', $errorRows);
        }

        return redirect()->route('leads.index')->with('success', $message);
    }

    /**
     * Export leads as CSV file.
     */
    public function export(): StreamedResponse
    {
        $filename = 'leads_' . now()->format('Ymd') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = [
            'id', 'company_name', 'contact_name', 'email', 'phone',
            'phone_ng', 'rank', 'status', 'deal_status',
            'last_sales_status', 'email_notes', 'call_notes', 'notes',
            'created_at',
        ];

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM（Excelで文字化け防止）
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, $columns);

            Lead::query()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->chunk(500, function ($leads) use ($handle, $columns) {
                    foreach ($leads as $lead) {
                        $row = [];
                        foreach ($columns as $col) {
                            if ($col === 'phone_ng') {
                                $row[] = $lead->phone_ng ? '1' : '0';
                            } else {
                                $row[] = $lead->$col ?? '';
                            }
                        }
                        fputcsv($handle, $row);
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
