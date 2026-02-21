<x-layouts.app :title="__('Dashboard')">
    <div class="Activity-layout">
      <h2>活動一覧</h2>
      <a href="{{ route('activities.create') }}" class="create">新規作成</a>

      <div class="Activity-searchForm">
        <h3>活動検索フォーム</h3>
        <form action="{{ route('activities.index') }}" method="GET">
          <label for="type">商談名:</label>
          <select id="type" name="type">
            <option value="">すべて</option>
            @foreach($typeOptions as $typeOption)
              <option value="{{ $typeOption }}" {{ ($type ?? '') === $typeOption ? 'selected' : '' }}>
                {{ $typeOption }}
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


          <label for="description" class="ml-4">説明:</label>
          <input type="text" id="description" name="description" value="{{ $description ?? '' }}" placeholder="説明で部分一致検索">

          <button type="submit" class="ml-4">検索</button>
          <a href="{{ route('activities.index') }}" class="ml-2 text-blue-500 hover:underline">リセット</a>
        </form>
      </div>

      <div class="Activity-table">
        <table class="Activity-table-layout">
          <thead>
            <tr>
              <!-- <th class="px-4 py-2">ID</th> -->
              <th class="px-4 py-2">タイトル</th>
              <th class="px-4 py-2">タイプ</th>
              <th class="px-4 py-2">会社</th>
              <th class="px-4 py-2">連絡先</th>
              <th class="px-4 py-2">予定日時</th>
              <th class="px-4 py-2">説明</th>
              <th class="px-4 py-2">詳細</th>
              <th class="px-4 py-2">編集</th>
              <th class="px-4 py-2">削除</th>
            </tr>
          </thead>
          <tbody>
            @forelse($activities as $hensu)
              <tr>
                <td class="border px-4 py-2 text-center">{{ $hensu->title }}</td>
                <td class="border px-4 py-2 text-center">{{ $hensu->type }}</td>
                <td class="border px-4 py-2 text-center">{{ optional($hensu->company)->name }}</td>
                <td class="border px-4 py-2 text-center">{{ optional($hensu->contact)->first_name }} {{ optional($hensu->contact)->last_name }}</td>
                <td class="border px-4 py-2 text-center">{{ $hensu->date }}</td>
                <td class="border px-4 py-2 text-center">{{ $hensu?->description }}</td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('activities.show', $hensu->id) }}" class="text-blue-500 hover:underline">詳細</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <a href="{{ route('activities.edit', $hensu->id) }}" class="text-green-500 hover:underline">編集</a>
                </td>
                <td class="border px-4 py-2 text-center">
                  <form action="{{ route('activities.destroy', $hensu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
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
