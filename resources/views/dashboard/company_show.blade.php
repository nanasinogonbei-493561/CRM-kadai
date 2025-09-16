<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社詳細ページ</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ $company->name }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">住所:</label>
          <p class="text-gray-900">{{ $company->address }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">電話番号:</label>
          <p class="text-gray-900">{{ $company->phone }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メールアドレス:</label>
          <p class="text-gray-900">{{ $company->email }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ウェブサイト:</label>
          <p class="text-gray-900">{{ $company->website }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">説明:</label>
          <p class="text-gray-900">{{ $company->description }}</p>
        </div>
      </div>
    </div>

</x-layouts.app>