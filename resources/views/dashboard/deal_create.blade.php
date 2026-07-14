<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>商談作成フォーム</h2>

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="text-red-600">{{ $error }}</div>
        @endforeach
      @endif

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const companySelect = document.getElementById('company_id');
          const contactSelect = document.getElementById('contact_id');

          companySelect.addEventListener('change', function() {
            const companyId = this.value;
            contactSelect.innerHTML = '<option value="">連絡先を選択してください</option>';
            if (!companyId) return;
            fetch(`/api/contacts/${companyId}`)
              .then(r => r.json())
              .then(data => {
                data.forEach(contact => {
                  const opt = document.createElement('option');
                  opt.value = contact.id;
                  opt.textContent = `${contact.first_name} ${contact.last_name}`;
                  contactSelect.appendChild(opt);
                });
              });
          });
        });
      </script>

      <form method="POST" action="{{ route('deals.store') }}">
        @csrf

        <div class="mb-4">
          <label for="title" class="form-label">タイトル <span class="text-red-500">*</span></label>
          <input type="text" name="title" id="title" value="{{ old('title') }}"
            class="form-input" required>
        </div>

        <div class="mb-4">
          <label for="company_id" class="form-label">会社 <span class="text-red-500">*</span></label>
          <select name="company_id" id="company_id"
            class="form-input" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="contact_id" class="form-label">連絡先</label>
          <select name="contact_id" id="contact_id"
            class="form-input">
            <option value="">連絡先を選択してください</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="status" class="form-label">商談前ステータス</label>
          <select name="status" id="status"
            class="form-input">
            <option value="">選択してください</option>
            @foreach(['商談中','成約','検討','断り済','失注'] as $s)
              <option value="{{ $s }}" {{ old('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="deal_status" class="form-label">商談後ステータス</label>
          <select name="deal_status" id="deal_status"
            class="form-input">
            <option value="">選択してください</option>
            @foreach(['成約','検討','商談設定中'] as $ds)
              <option value="{{ $ds }}" {{ old('deal_status') === $ds ? 'selected' : '' }}>{{ $ds }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="date" class="form-label">商談日</label>
          <input type="date" name="date" id="date" value="{{ old('date') }}"
            class="form-input">
        </div>

        <div class="mb-4">
          <label for="probability" class="form-label">確度(%):</label>
          <input type="number" name="probability" id="probability" value="{{ old('probability') }}"
            class="form-input" min="0" max="100">
        </div>

        <div class="mb-4">
          <label for="description" class="form-label">説明</label>
          <textarea name="description" id="description" rows="4"
            class="form-input">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
          <label for="notes" class="form-label">備考</label>
          <textarea name="notes" id="notes" rows="4"
            class="form-input">{{ old('notes') }}</textarea>
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>
          <a href="{{ route('deals.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
