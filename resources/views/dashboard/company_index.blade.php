<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社一覧</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr>
              <th class="px-4 py-2">ID</th>
              <th class="px-4 py-2">会社名</th>
              <th class="px-4 py-2">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($companies as $hensu)
              <tr>
                <td class="border px-4 py-2">{{ $hensu->id }}</td>
                <td class="border px-4 py-2">{{ $hensu->name }}</td>
                <td class="border px-4 py-2">
                  <!-- アクションボタンなど -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</x-layouts.app>