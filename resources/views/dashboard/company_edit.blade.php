<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社編集フォーム</h2>
      <form method="POST" action="{{ route('companies.update', $company->id) }}" class="" >
        @csrf
        <div class="mb-4">
          <label for="name" class="form-label">会社名:</label>
          <input type="text" name="name" id="name" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="address" class="form-label">住所:</label>
          <input type="text" name="address" id="address" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="form-label">電話番号:</label>
          <input type="text" name="phone" id="phone" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="email" class="form-label">メールアドレス:</label>
          <input type="email" name="email" id="email" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="website" class="form-label">ウェブサイト:</label>
          <input type="url" name="website" id="website" class="form-input">
        </div>
        <div class="mb-4">
          <label for="description" class="form-label">説明:</label>
          <textarea name="description" id="description" rows="4" class="form-input</textarea>
          </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>

          <a href="{{ route('companies.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
    </div>
</x-layouts.app>