<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl dark:text-white">
      <h2>会社作成フォーム</h2>
      <form method="POST" action="{{ route('companies.store') }}" class="" >
        @csrf
        <div class="mb-4 dark:text-white">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">会社名:</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:text-white" required>
        </div>
        <div class="mb-4 dark:text-white">
          <label for="address" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">住所:</label>
          <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:text-white" required>
        </div>
        <div class="mb-4 dark:text-white">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">電話番号:</label>
          <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:text-white" required>
        </div>
        <div class="mb-4 dark:text-white">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">メールアドレス:</label>
          <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:text-white" required>
        </div>
        <div class="mb-4 dark:text-white">
          <label for="website" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">ウェブサイト:</label>
          <input type="url" name="website" id="website" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:text-white">
        </div>
        <div class="mb-4 dark:text-white">
          <label for="description" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">説明:</label>
          <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
          </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>

          <a href="{{ route('companies.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
    </div>
</x-layouts.app>