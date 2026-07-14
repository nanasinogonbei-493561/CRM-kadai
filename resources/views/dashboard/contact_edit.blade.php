<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社編集フォーム</h2>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
      @endif
      <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="" >
        @csrf
        @method('PUT')
        <div class="mb-4">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <label for="company_id" class="form-label">会社:</label>
          <select name="company_id" id="company_id" class="form-input" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}" @selected($company->id == $contact->company_id)>{{ $company->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="first_name" class="form-label">苗字:</label>
          <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $contact->first_name) }}" class="form-input">
          <p>{{ $contact->first_name }}</p>
        </div>
        <div class="mb-4">
          <label for="last_name" class="form-label">名前:</label>
          <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $contact->last_name) }}" class="form-input">
          <p>{{ $contact->last_name }}</p>
        </div>
        <div class="mb-4">
          <label for="position" class="form-label">役職:</label>
          <input type="text" name="position" id="position" value="{{ old('position', $contact->position) }}" class="form-input">
          <p>{{ $contact->position }}</p>
        </div>
        <div class="mb-4">
          <label for="email" class="form-label">メールアドレス:</label>
          <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}" class="form-input">
          <p>{{ $contact->email }}</p>
        </div>
        <div class="mb-4">
          <label for="phone" class="form-label">電話番号:</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" class="form-input">
          <p>{{ $contact->phone }}</p>
        </div>
        <div class="mb-4">
          <label for="mobile" class="form-label">携帯電話番号:</label>
          <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $contact->mobile) }}" class="form-input">
          <p>{{ $contact->mobile }}</p>
        </div>
        <div class="mb-4">
          <label for="notes" class="form-label">メモ:</label>
          <textarea name="notes" id="notes" rows="4" class="form-input">{{ old('notes', $contact->notes) }}</textarea>
          <p>{{ $contact->notes }}</p>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            更新
          </button>


          <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
