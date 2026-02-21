<x-layouts.app :title="__('Dashboard')">
    <div class="Contact-layout">
      <h2>連絡先一覧</h2>
      <a href="{{ route('contacts.create') }}" class="create">新規作成</a>

      <div class="Contact-searchForm">
        <h3>連絡先検索フォーム</h3>
        <form action="{{ route('contacts.index') }}" method="GET">
          <label for="company_id">会社名:</label>
          <select id="company_id" name="company_id">
            <option value="">すべて</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}" {{ (string)($companyId ?? '') === (string)$company->id ? 'selected' : '' }}>
                {{ $company->name }}
              </option>
            @endforeach
          </select>
          <br><br>
          <button type="submit">検索</button>
          <a href="{{ route('contacts.index') }}" class="ml-2 text-blue-500 hover:underline">リセット</a>
        </form>
      </div>

      <div class="Contact-table">
        <table class="Contact-table-layout">
          <thead>
            <tr>
              <!-- <th class="px-4 py-2">ID</th> -->
              <th class="px-4 py-2">苗字</th>
              <th class="px-4 py-2">名前</th>
              <th class="px-4 py-2">役職</th>
              <th class="px-4 py-2">詳細</th>
              <th class="px-4 py-2">編集</th>
              <th class="px-4 py-2">削除</th>
            </tr>
          </thead>
          <tbody>
            @forelse($contacts as $hensu)
              <tr>
                <td class="border px-4 py-2 text-center">{{ $hensu->first_name }}</td>
                <td class="border px-4 py-2 text-center">{{ $hensu->last_name }}</td>
                <td class="border px-4 py-2 text-center">{{ $hensu->position }}</td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('contacts.show', $hensu->id) }}" class="text-blue-500 hover:underline">詳細</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('contacts.edit', $hensu->id) }}" class="text-green-500 hover:underline">編集</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <form action="{{ route('contacts.destroy', $hensu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">削除</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td class="border px-4 py-2 text-center" colspan="6">検索結果がありません。</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
</x-layouts.app>
