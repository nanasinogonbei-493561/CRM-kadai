<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動詳細ページ</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ optional($companies->firstWhere('id', $activity->company_id))->name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">連絡先:</label>
          <p class="text-gray-900">{{ optional($activity->contact)->first_name }} {{ optional($activity->contact)->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">商談:</label>
          <p class="text-gray-900">{{ optional($activity->deal)->title }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">タイプ:</label>
          <p class="text-gray-900">{{ $activity->type }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">タイトル:</label>
          <p class="text-gray-900">{{ $activity->title }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">説明:</label>
          <p class="text-gray-900">{{ $activity->description }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">見込み成約日:</label>
          <p class="text-gray-900">{{ $activity->date }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ステータス:</label>
          <p class="text-gray-900">{{ $activity->status }}</p>
        </div>
      </div>
    </div>
</x-layouts.app>
