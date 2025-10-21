<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社編集フォーム</h2>
      <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="" >
        @csrf
        <div class="mb-4">
          <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">苗字:</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">名前:</label>
          <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="position" class="block text-gray-700 text-sm font-bold mb-2">役職:</label>
          <input type="text" name="position" id="position" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">メールアドレス:</label>
          <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">電話番号:</label>
          <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="mobile" class="block text-gray-700 text-sm font-bold mb-2">携帯電話番号:</label>
          <input type="text" name="mobile" id="mobile" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
          <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">メモ:</label>
          <textarea name="text" id="notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3</textarea>
          </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>


          <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
    </div>
</x-layouts.app>