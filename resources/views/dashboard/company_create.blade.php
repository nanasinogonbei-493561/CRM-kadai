<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社作成フォーム</h2>
      <form method="POST" action="{{ route('companies.store') }}" class="flex flex" >
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="address" class="block text-gray-700 text-sm font-bold mb-2">住所:</label>
          <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">電話番号:</label>
          <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">メールアドレス:</label>
          <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="website" class="block text-gray-700 text-sm font-bold mb-2">ウェブサイト:</label>
          <input type="url" name="website" id="website" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700 text-sm font-bold mb-2">説明:</label>
          <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3
    </div>
</x-layouts.app>