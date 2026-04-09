<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動編集フォーム</h2>

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
          const currentContactId = contactSelect.dataset.currentContactId;
          const currentDealId    = dealSelect.dataset.currentDealId;

          function loadContacts(companyId, selectedId) {
            contactSelect.innerHTML = '<option value="">連絡先を選択してください</option>';
            if (!companyId) return;
            fetch(`/api/contacts/${companyId}`)
              .then(r => r.json())
              .then(data => {
                data.forEach(contact => {
                  const opt = document.createElement('option');
                  opt.value = contact.id;
                  opt.textContent = `${contact.first_name} ${contact.last_name}`;
                  if (selectedId && String(contact.id) === String(selectedId)) opt.selected = true;
                  contactSelect.appendChild(opt);
                });
              });
          }

          function loadDeals(companyId, selectedId) {
            dealSelect.innerHTML = '<option value="">商談を選択してください</option>';
            if (!companyId) return;
            fetch(`/api/deals/${companyId}`)
              .then(r => r.json())
              .then(data => {
                data.forEach(deal => {
                  const opt = document.createElement('option');
                  opt.value = deal.id;
                  opt.textContent = deal.title;
                  if (selectedId && String(deal.id) === String(selectedId)) opt.selected = true;
                  dealSelect.appendChild(opt);
                });
              });
          }

          companySelect.addEventListener('change', function() {
            loadContacts(this.value, null);
            loadDeals(this.value, null);
          });

          if (companySelect.value) {
            loadContacts(companySelect.value, currentContactId);
            loadDeals(companySelect.value, currentDealId);
          }
        });
      </script>

      <form method="POST" action="{{ route('activities.update', $activity->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label for="company_id" class="block text-white-700 text-sm font-bold mb-2">会社 <span class="text-red-500">*</span></label>
          <select name="company_id" id="company_id"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}" @selected($company->id == $activity->company_id)>{{ $company->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="contact_id" class="block text-white-700 text-sm font-bold mb-2">連絡先</label>
          <select name="contact_id" id="contact_id"
            data-current-contact-id="{{ old('contact_id', $activity->contact_id) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">連絡先を選択してください</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="deal_id" class="block text-white-700 text-sm font-bold mb-2">商談</label>
          <select name="deal_id" id="deal_id"
            data-current-deal-id="{{ old('deal_id', $activity->deal_id) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">商談を選択してください</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="type" class="block text-white-700 text-sm font-bold mb-2">種別 <span class="text-red-500">*</span></label>
          <select name="type" id="type"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">種別を選択してください</option>
            @foreach(['電話','メール','会議','タスク','メモ'] as $t)
              <option value="{{ $t }}" @selected(old('type', $activity->type) === $t)>{{ $t }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="title" class="block text-white-700 text-sm font-bold mb-2">タイトル <span class="text-red-500">*</span></label>
          <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-white-700 text-sm font-bold mb-2">説明</label>
          <textarea name="description" id="description" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('description', $activity->description) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="date" class="block text-white-700 text-sm font-bold mb-2">活動日</label>
          <input type="date" name="date" id="date" value="{{ old('date', $activity->date) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
          <label for="status" class="block text-white-700 text-sm font-bold mb-2">ステータス</label>
          <select name="status" id="status"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">ステータスを選択してください</option>
            @foreach(['予定','完了','キャンセル済み'] as $s)
              <option value="{{ $s }}" @selected(old('status', $activity->status) === $s)>{{ $s }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4 flex items-center gap-2">
          <input type="checkbox" name="phone_ng" id="phone_ng" value="1"
            {{ old('phone_ng', $activity->phone_ng) ? 'checked' : '' }}>
          <label for="phone_ng" class="text-white-700 text-sm font-bold">電話NG</label>
        </div>

        <div class="mb-4">
          <label for="last_sales_status" class="block text-white-700 text-sm font-bold mb-2">最終営業状況</label>
          <textarea name="last_sales_status" id="last_sales_status" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('last_sales_status', $activity->last_sales_status) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="email_notes" class="block text-white-700 text-sm font-bold mb-2">メール備考</label>
          <textarea name="email_notes" id="email_notes" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('email_notes', $activity->email_notes) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="call_notes" class="block text-white-700 text-sm font-bold mb-2">着電日報備考</label>
          <textarea name="call_notes" id="call_notes" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('call_notes', $activity->call_notes) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            更新
          </button>
          <a href="{{ route('activities.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
