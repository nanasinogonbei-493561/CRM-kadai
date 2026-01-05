<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>連絡先詳細ページ</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ optional($companies->firstWhere('id', $contact->company_id))->name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">苗字:</label>
          <p class="text-gray-900">{{ $contact->first_name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">名前:</label>
          <p class="text-gray-900">{{ $contact->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">役職:</label>
          <p class="text-gray-900">{{ $contact->position }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メールアドレス:</label>
          <p class="text-gray-900">{{ $contact->email }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">電話番号:</label>
          <p class="text-gray-900">{{ $contact->phone }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">携帯電話番号:</label>
          <p class="text-gray-900">{{ $contact->mobile }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メモ:</label>
          <p class="text-gray-900">{{ $contact->notes }}</p>
        </div>
      </div>
    </div>
</x-layouts.app>
