<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>連絡先一覧</h2>
      <a href="{{ route('contacts.create') }}" class="text-blue-500 hover:underline">新規作成</a>
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
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
            @foreach($contacts as $hensu)
              <tr>
                <td class="border px-4 py-2">{{ $hensu->id }}</td>
                <td class="border px-4 py-2">{{ $hensu->name }}</td>
                <td class="border px-4 py-2">
                  <a href="{{ route('contacts.show', $hensu->id) }}" class="text-blue-500 hover:underline">詳細</a>
                </td>
                <td class="border px-4 py-2">
                  <a href="{{ route('contacts.edit', $hensu->id) }}" class="text-green-500 hover:underline">編集</a>
                </td>
                <td class="border px-4 py-2">
                  <form action="{{ route('contacts.destroy', $hensu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">削除</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</x-layouts.app>