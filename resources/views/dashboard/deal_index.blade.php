<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>商談一覧</h2>
      <a href="{{ route('deals.create') }}" class="text-blue-500 hover:underline">新規作成</a>

      <div>
        <h3>商談検索フォーム</h3>
        <form action="{{ route('deals.index') }}" method="GET">
          <label for="title">商談名:</label>
          <select id="title" name="title">
            <option value="">すべて</option>
            @foreach($titleOptions as $titleOption)
              <option value="{{ $titleOption }}" {{ ($title ?? '') === $titleOption ? 'selected' : '' }}>
                {{ $titleOption }}
              </option>
            @endforeach
          </select>

          <label for="company_id" class="ml-4">会社:</label>
          <select id="company_id" name="company_id">
            <option value="">すべて</option>
            @foreach($companyOptions as $companyOption)
              <option value="{{ $companyOption->id }}" {{ (string)($companyId ?? '') === (string)$companyOption->id ? 'selected' : '' }}>
                {{ $companyOption->name }}
              </option>
            @endforeach
          </select>

          <label for="status" class="ml-4">ステータス:</label>
          <select id="status" name="status">
            <option value="">すべて</option>
            @foreach($statusOptions as $statusOption)
              <option value="{{ $statusOption }}" {{ ($status ?? '') === $statusOption ? 'selected' : '' }}>
                {{ $statusOption }}
              </option>
            @endforeach
          </select>

          <button type="submit" class="ml-4">検索</button>
          <a href="{{ route('deals.index') }}" class="ml-2 text-blue-500 hover:underline">リセット</a>
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr>
              <!-- <th class="px-4 py-2">ID</th> -->
              <th class="px-4 py-2">タイトル</th>
              <th class="px-4 py-2">会社</th>
              <th class="px-4 py-2">連絡先</th>
              <th class="px-4 py-2">金額</th>
              <th class="px-4 py-2">ステータス</th>
              <th class="px-4 py-2">見込み成約日</th>
              <th class="px-4 py-2">詳細</th>
              <th class="px-4 py-2">編集</th>
              <th class="px-4 py-2">削除</th>
            </tr>
          </thead>
          <tbody>
            @forelse($deals as $hensu)
              <tr>
                <td class="border px-4 py-2">{{ $hensu->title }}</td>
                <td class="border px-4 py-2">{{ optional($hensu->company)->name }}</td>
                <td class="border px-4 py-2">{{ optional($hensu->contact)->first_name }} {{ optional($hensu->contact)->last_name }}</td>
                <td class="border px-4 py-2">{{ $hensu->amount }}</td>
                <td class="border px-4 py-2">{{ $hensu->status }}</td>
                <td class="border px-4 py-2">{{ $hensu->date }}</td>
                <td class="border px-4 py-2">
                  <a href="{{ route('deals.show', $hensu->id) }}" class="text-blue-500 hover:underline">詳細</a>
                </td>
                <td class="border px-4 py-2">
                  <a href="{{ route('deals.edit', $hensu->id) }}" class="text-green-500 hover:underline">編集</a>
                </td>
                <td class="border px-4 py-2">
                  <form action="{{ route('deals.destroy', $hensu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
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
</x-layouts.app>
