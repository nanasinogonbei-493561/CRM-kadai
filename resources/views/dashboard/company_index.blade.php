<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社一覧</h2>
      <a href="{{ route('companies.create') }}" class="text-blue-500 hover:underline">新規作成</a>

      <div>
        <h3>会社検索フォーム</h3>
        <form action="{{ route('companies.index') }}" method="GET">
          <label for="name">会社名:</label>
          <input type="text" id="name" name="name" value="{{ $name ?? '' }}" placeholder="会社名を入力してください"><br><br>
          <button type="submit">検索</button>
          <a href="{{ route('companies.index') }}" class="ml-2 text-blue-500 hover:underline">リセット</a>
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr>
              <th class="px-4 py-2">ID</th>
              <th class="px-4 py-2">会社名</th>
              <th class="px-4 py-2">詳細</th>
              <th class="px-4 py-2">編集</th>
              <th class="px-4 py-2">削除</th>
            </tr>
          </thead>
          <tbody>
            @forelse($companies as $hensu)
                <tr>
                  <td class="border px-4 py-2">{{ $hensu->id }}</td>
                  <td class="border px-4 py-2">{{ $hensu->name }}</td>
                  <td class="border px-4 py-2">
                    <a href="{{ route('companies.show', $hensu->id) }}" class="text-blue-500 hover:underline">詳細</a>
                  </td>
                  <td class="border px-4 py-2">
                    <a href="{{ route('companies.edit', $hensu->id) }}" class="text-green-500 hover:underline">編集</a>
                  </td>
                  <td class="border px-4 py-2">
                    <form action="{{ route('companies.destroy', $hensu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:underline">削除</button>
                    </form>
                  </td>
                </tr>
            @empty
                <tr>
                  <td class="border px-4 py-2 text-center" colspan="5">検索結果がありません。</td>
                </tr>
            @endforelse
          </tbody>
        </table>
    </div>
</x-layouts.app>
