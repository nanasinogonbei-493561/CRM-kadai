<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動作成フォーム</h2>

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="text-red-600">{{ $error }}</div>
        @endforeach
      @endif

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const companySelect = document.getElementById('company_id');
          const contactSelect = document.getElementById('contact_id');
          const dealSelect    = document.getElementById('deal_id');

          companySelect.addEventListener('change', function() {
            const companyId = this.value;

            contactSelect.innerHTML = '<option value="">連絡先を選択してください</option>';
            dealSelect.innerHTML    = '<option value="">商談を選択してください</option>';

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

            fetch(`/api/deals/${companyId}`)
              .then(r => r.json())
              .then(data => {
                data.forEach(deal => {
                  const opt = document.createElement('option');
                  opt.value = deal.id;
                  opt.textContent = deal.title;
                  dealSelect.appendChild(opt);
                });
              });
          });
        });
      </script>

      <form method="POST" action="{{ route('activities.store') }}">
        @csrf

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
          <label for="deal_id" class="form-label">商談</label>
          <select name="deal_id" id="deal_id"
            class="form-input">
            <option value="">商談を選択してください</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="type" class="form-label">種別 <span class="text-red-500">*</span></label>
          <select name="type" id="type"
            class="form-input" required>
            <option value="">種別を選択してください</option>
            @foreach(['電話','メール','会議','タスク','メモ'] as $t)
              <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="title" class="form-label">タイトル <span class="text-red-500">*</span></label>
          <input type="text" name="title" id="title" value="{{ old('title') }}"
            class="form-input" required>
        </div>

        <div class="mb-4">
          <label for="description" class="form-label">説明</label>
          <textarea name="description" id="description" rows="3"
            class="form-input">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
          <label for="date" class="form-label">活動日</label>
          <input type="date" name="date" id="date" value="{{ old('date') }}"
            class="form-input">
        </div>

        <div class="mb-4">
          <label for="status" class="form-label">ステータス</label>
          <select name="status" id="status"
            class="form-input">
            <option value="">ステータスを選択してください</option>
            @foreach(['予定','完了','キャンセル済み'] as $s)
              <option value="{{ $s }}" {{ old('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4 flex items-center gap-2">
          <input type="checkbox" name="phone_ng" id="phone_ng" value="1" {{ old('phone_ng') ? 'checked' : '' }}>
          <label for="phone_ng" class="form-label">電話NG</label>
        </div>

        <div class="mb-4">
          <label for="last_sales_status" class="form-label">最終営業状況</label>
          <textarea name="last_sales_status" id="last_sales_status" rows="3"
            class="form-input">{{ old('last_sales_status') }}</textarea>
        </div>

        <div class="mb-4">
          <label for="email_notes" class="form-label">メール備考</label>
          <textarea name="email_notes" id="email_notes" rows="3"
            class="form-input">{{ old('email_notes') }}</textarea>
        </div>

        <div class="mb-4">
          <label for="call_notes" class="form-label">着電日報備考</label>
          <textarea name="call_notes" id="call_notes" rows="3"
            class="form-input">{{ old('call_notes') }}</textarea>
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>
          <a href="{{ route('activities.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
