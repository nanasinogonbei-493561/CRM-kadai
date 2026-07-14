<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>連絡先作成フォーム</h2>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
      @endif
      <form method="POST" action="{{ route('contacts.store') }}" class="" >
        @csrf
        <div class="mb-4">
          <label for="company_id" class="form-label">会社:</label>
          <select name="company_id" id="company_id" class="form-input" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="mb-4">
          <label for="first_name" class="form-label">苗字:</label>
          <input type="text" name="first_name" id="first_name" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="last_name" class="form-label">名前:</label>
          <input type="text" name="last_name" id="last_name" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="position" class="form-label">役職:</label>
          <input type="text" name="position" id="position" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="email" class="form-label">メールアドレス:</label>
          <input type="email" name="email" id="email" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="form-label">電話番号:</label>
          <input type="text" name="phone" id="phone" class="form-input" required>
        </div><div class="mb-4">
          <label for="mobile" class="form-label">携帯電話番号:</label>
          <input type="text" name="mobile" id="mobile" class="form-input" required>
        </div>
        <div class="mb-4">
          <label for="notes" class="form-label">メモ:</label>
          <textarea name="notes" id="notes" rows="4" class="form-input"></textarea>
          </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>

          <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>

</x-layouts.app>