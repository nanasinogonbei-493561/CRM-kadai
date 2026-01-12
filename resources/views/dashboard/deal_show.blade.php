<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>商談詳細ページ</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">タイトル:</label>
          <p class="text-gray-900">{{ $deal->title }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ optional($companies->firstWhere('id', $deal->company_id))->name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">連絡先:</label>
          <p class="text-gray-900">{{ optional($deal->contact)->first_name }} {{ optional($deal->contact)->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">金額:</label>
          <p class="text-gray-900">{{ $deal->amount }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ステータス:</label>
          <p class="text-gray-900">{{ $deal->status }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">見込み成約日:</label>
          <p class="text-gray-900">{{ $deal->date }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">確率(%):</label>
          <p class="text-gray-900">{{ Number::percentage($deal->probability) }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">説明:</label>
          <p class="text-gray-900">{{ $deal->description }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">備考:</label>
          <p class="text-gray-900">{{ $deal->notes }}</p>
        </div>
      </div>
    </div>
</x-layouts.app>
