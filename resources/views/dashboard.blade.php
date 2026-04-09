<x-layouts.app :title="__('Dashboard')">

    <div class="space-y-6">

        {{-- 商談ステータス別件数 --}}
        <div>
            <h2 class="text-lg font-semibold mb-3">商談ステータス別件数</h2>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-5">
                @foreach ($dealStatusData as $status => $count)
                    <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 text-center">
                        <div class="text-sm text-neutral-500 mb-1">{{ $status }}</div>
                        <div class="text-2xl font-bold">{{ $count }}</div>
                        <div class="text-xs text-neutral-400">件</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- リードランク別件数 --}}
        <div>
            <h2 class="text-lg font-semibold mb-3">リードランク別件数</h2>
            @if ($leadRankCounts->isEmpty())
                <p class="text-sm text-neutral-400">データがありません</p>
            @else
                <div class="grid grid-cols-2 gap-4 md:grid-cols-5">
                    @foreach ($leadRankCounts as $rank => $count)
                        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 text-center">
                            <div class="text-sm text-neutral-500 mb-1">ランク {{ $rank }}</div>
                            <div class="text-2xl font-bold">{{ $count }}</div>
                            <div class="text-xs text-neutral-400">件</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- 担当ユーザー別活動件数 --}}
        <div>
            <h2 class="text-lg font-semibold mb-3">担当ユーザー別活動件数</h2>
            @if ($userActivityCounts->isEmpty())
                <p class="text-sm text-neutral-400">データがありません</p>
            @else
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach ($userActivityCounts as $item)
                        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 text-center">
                            <div class="text-sm text-neutral-500 mb-1">{{ $item['name'] }}</div>
                            <div class="text-2xl font-bold">{{ $item['count'] }}</div>
                            <div class="text-xs text-neutral-400">件</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- 最近の活動一覧 --}}
        <div>
            <h2 class="text-lg font-semibold mb-3">最近の活動</h2>
            @if ($recentActivities->isEmpty())
                <p class="text-sm text-neutral-400">データがありません</p>
            @else
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-neutral-50 dark:bg-neutral-800">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-neutral-600 dark:text-neutral-300">活動日</th>
                                <th class="px-4 py-2 text-left font-medium text-neutral-600 dark:text-neutral-300">会社名</th>
                                <th class="px-4 py-2 text-left font-medium text-neutral-600 dark:text-neutral-300">種別</th>
                                <th class="px-4 py-2 text-left font-medium text-neutral-600 dark:text-neutral-300">タイトル</th>
                                <th class="px-4 py-2 text-left font-medium text-neutral-600 dark:text-neutral-300">担当者</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @foreach ($recentActivities as $activity)
                                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800">
                                    <td class="px-4 py-2 text-neutral-500">
                                        {{ $activity->date ? $activity->date->format('Y/m/d') : '—' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('companies.show', $activity->company_id) }}" class="hover:underline">
                                            {{ $activity->company?->name ?? '—' }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $activity->type }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('activities.show', $activity->id) }}" class="hover:underline">
                                            {{ $activity->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-neutral-500">{{ $activity->user?->name ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

</x-layouts.app>
