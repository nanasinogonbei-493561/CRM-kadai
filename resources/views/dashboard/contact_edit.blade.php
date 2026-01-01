<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社編集フォーム</h2>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
      @endif
      <form method="PUT" action="{{ route('contacts.update', $company->id) }}" class="" >
        @csrf
        <div class="mb-4">
          <label for="company_id" class="block text-white-700 text-sm font-bold mb-2">会社:</label>
          <select name="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>
          <p>{{ $company->name }}</p>
        </div>

        <div class="mb-4">
          <label for="first_name" class="block text-white-700 text-sm font-bold mb-2">苗字:</label>
          <input type="name" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->first_name }}</p>
        </div>
        <div class="mb-4">
          <label for="last_name" class="block text-white-700 text-sm font-bold mb-2">名前:</label>
          <input type="name" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->last_name }}</p>
        </div>
        <div class="mb-4">
          <label for="position" class="block text-white-700 text-sm font-bold mb-2">役職:</label>
          <input type="text" name="position" id="position" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->position }}</p>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-white-700 text-sm font-bold mb-2">メールアドレス:</label>
          <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->email }}</p>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-white-700 text-sm font-bold mb-2">電話番号:</label>
          <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->phone }}</p>
        </div>
        <div class="mb-4">
          <label for="mobile" class="block text-white-700 text-sm font-bold mb-2">携帯電話番号:</label>
          <input type="text" name="mobile" id="mobile" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $contact->mobile }}</p>
        </div>
        <div class="mb-4">
          <label for="notes" class="block text-white-700 text-sm font-bold mb-2">メモ:</label>
          <textarea name="nates" id="notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>


          <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
    </div>
</x-layouts.app>