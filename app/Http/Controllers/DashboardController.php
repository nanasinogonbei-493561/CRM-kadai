<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 商談ステータス別件数
        $dealStatusCounts = Deal::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $dealStatuses = ['商談前', '成約', '検討', '内諾', '失注'];
        $dealStatusData = [];
        foreach ($dealStatuses as $status) {
            $dealStatusData[$status] = $dealStatusCounts[$status] ?? 0;
        }

        // リードランク別件数
        $leadRankCounts = Lead::selectRaw('rank, count(*) as count')
            ->whereNotNull('rank')
            ->groupBy('rank')
            ->orderBy('rank')
            ->pluck('count', 'rank');

        // 最近の活動一覧（直近10件）
        $recentActivities = Activity::with(['company', 'user'])
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // 担当ユーザー別活動件数
        $userActivityCounts = Activity::selectRaw('user_id, count(*) as count')
            ->groupBy('user_id')
            ->with('user')
            ->get()
            ->map(fn($a) => [
                'name'  => $a->user?->name ?? '不明',
                'count' => $a->count,
            ])
            ->sortByDesc('count')
            ->values();

        return view('dashboard', compact(
            'dealStatusData',
            'leadRankCounts',
            'recentActivities',
            'userActivityCounts',
        ));
    }
}
