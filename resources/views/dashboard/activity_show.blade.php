<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動詳細ページ</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ optional($activity->company)->name }}</p>
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
          <label class="block text-gray-700 text-sm font-bold mb-2">種別:</label>
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
          <label class="block text-gray-700 text-sm font-bold mb-2">活動日:</label>
          <p class="text-gray-900">{{ $activity->date }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ステータス:</label>
          <p class="text-gray-900">{{ $activity->status }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">電話NG:</label>
          <p class="text-gray-900">{{ $activity->phone_ng ? 'はい' : 'いいえ' }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">最終営業状況:</label>
          <p class="text-gray-900">{{ $activity->last_sales_status }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メール備考:</label>
          <p class="text-gray-900">{{ $activity->email_notes }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">着電日報備考:</label>
          <p class="text-gray-900">{{ $activity->call_notes }}</p>
        </div>

        <div class="flex items-center gap-4 mt-6">
          <a href="{{ route('activities.edit', $activity->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            編集
          </a>
          <a href="{{ route('activities.index') }}" class="text-blue-500 hover:underline">一覧へ戻る</a>
        </div>
      </div>
    </div>
</x-layouts.app>
