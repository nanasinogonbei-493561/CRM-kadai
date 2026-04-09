<x-layouts.app :title="__('Dashboard')">
    <div class="Lead-layout">
      <h2>リード一覧</h2>

      @if (session('success'))
        <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
      @endif

      <div class="flex gap-4 mb-4">
        <a href="{{ route('leads.create') }}" class="create">新規作成</a>

        {{-- CSVインポート --}}
        <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
          @csrf
          <input type="file" name="csv_file" accept=".csv" required class="text-sm">
          <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
            CSVインポート
          </button>
        </form>

        {{-- CSVエクスポート --}}
        <a href="{{ route('leads.export') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-sm">
          CSVエクスポート
        </a>
      </div>

      <div class="Lead-searchForm">
        <h3>リード検索フォーム</h3>
        <form action="{{ route('leads.index') }}" method="GET">
          <label for="company_name">会社名:</label>
          <input type="text" id="company_name" name="company_name" value="{{ $companyName ?? '' }}" placeholder="会社名で部分一致検索">

          <label for="rank" class="ml-4">ランク:</label>
          <select id="rank" name="rank">
            <option value="">すべて</option>
            @foreach($rankOptions as $rankOption)
              <option value="{{ $rankOption }}" {{ ($rank ?? '') === $rankOption ? 'selected' : '' }}>
                {{ $rankOption }}
              </option>
            @endforeach
          </select>

          <label for="status" class="ml-4">状況:</label>
          <select id="status" name="status">
            <option value="">すべて</option>
            @foreach($statusOptions as $statusOption)
              <option value="{{ $statusOption }}" {{ ($status ?? '') === $statusOption ? 'selected' : '' }}>
                {{ $statusOption }}
              </option>
            @endforeach
          </select>

          <label for="deal_status" class="ml-4">商談後ステータス:</label>
          <select id="deal_status" name="deal_status">
            <option value="">すべて</option>
            @foreach($dealStatusOptions as $dealStatusOption)
              <option value="{{ $dealStatusOption }}" {{ ($dealStatus ?? '') === $dealStatusOption ? 'selected' : '' }}>
                {{ $dealStatusOption }}
              </option>
            @endforeach
          </select>

          <button type="submit" class="ml-4">検索</button>
          <a href="{{ route('leads.index') }}" class="ml-2 text-blue-500 hover:underline">リセット</a>
        </form>
      </div>

      <div class="Lead-table">
        <table class="Lead-table-layout">
          <thead>
            <tr>
              <th class="px-4 py-2">会社名</th>
              <th class="px-4 py-2">担当者名</th>
              <th class="px-4 py-2">ランク</th>
              <th class="px-4 py-2">状況</th>
              <th class="px-4 py-2">商談後ステータス</th>
              <th class="px-4 py-2">電話NG</th>
              <th class="px-4 py-2">最終営業状況</th>
              <th class="px-4 py-2">詳細</th>
              <th class="px-4 py-2">編集</th>
              <th class="px-4 py-2">削除</th>
            </tr>
          </thead>
          <tbody>
            @forelse($leads as $lead)
              <tr>
                <td class="border px-4 py-2 text-center">{{ $lead->company_name }}</td>
                <td class="border px-4 py-2 text-center">{{ $lead->contact_name }}</td>
                <td class="border px-4 py-2 text-center">{{ $lead->rank }}</td>
                <td class="border px-4 py-2 text-center">{{ $lead->status }}</td>
                <td class="border px-4 py-2 text-center">{{ $lead->deal_status }}</td>
                <td class="border px-4 py-2 text-center">
                  <input type="checkbox" disabled {{ $lead->phone_ng ? 'checked' : '' }}>
                </td>
                <td class="border px-4 py-2 text-center">{{ $lead->last_sales_status }}</td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('leads.show', $lead->id) }}" class="text-blue-500 hover:underline">詳細</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('leads.edit', $lead->id) }}" class="text-green-500 hover:underline">編集</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">削除</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td class="border px-4 py-2 text-center" colspan="10">検索結果がありません。</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
</x-layouts.app>
