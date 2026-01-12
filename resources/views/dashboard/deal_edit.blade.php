<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>商談編集フォーム</h2>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach

      @endif

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const companySelect = document.getElementById('company_id');
          const contactSelect = document.getElementById('contact_id');
          const currentContactId = contactSelect.dataset.currentContactId;

          function loadContacts(companyId, selectedId) {
            contactSelect.innerHTML = '<option value="">連絡先を選択してください</option>';
            if (!companyId) {
              return;
            }

            fetch(`/api/contacts/${companyId}`)
              .then(response => response.json())
              .then(data => {
                data.forEach(contact => {
                  const option = document.createElement('option');
                  option.value = contact.id;
                  option.textContent = `${contact.first_name} ${contact.last_name}`;
                  if (selectedId && String(contact.id) === String(selectedId)) {
                    option.selected = true;
                  }
                  contactSelect.appendChild(option);
                });
              })
              .catch(error => {
                console.error('連絡先の取得中にエラーが発生しました:', error);
              });
          }

          companySelect.addEventListener('change', function() {
            loadContacts(this.value, null);
          });

          if (companySelect.value) {
            loadContacts(companySelect.value, currentContactId);
          }
        });
        </script>

      <form method="POST" action="{{ route('deals.update', $deal->id) }}" class="" >
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="mb-4">
          <label for="title" class="block text-white-700 text-sm font-bold mb-2">タイトル:</label>
          <input type="text" name="title" id="title" value="{{ old('title', $deal->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $deal->title }}</p>
        </div>

        <div class="mb-4">
          <label for="company_id" class="block text-white-700 text-sm font-bold mb-2">会社:</label>
          <select name="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}" @selected($company->id == $deal->company_id)>{{ $company->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="contact_id" class="block text-white-700 text-sm font-bold mb-2">連絡先:</label>
          <select name="contact_id" id="contact_id" data-current-contact-id="{{ old('contact_id', $deal->contact_id) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>

          </select>
          <p>{{ $deal->contact_id }}</p>
        </div>
        <div class="mb-4">
          <label for="amount" class="block text-white-700 text-sm font-bold mb-2">金額(円):</label>
          <input type="integer" name="amount" id="amount" value="{{ old('amount', $deal->amount) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $deal->amount }}</p>
        </div>
        <div class="mb-4">
          <label for="status" class="block text-white-700 text-sm font-bold mb-2">ステータス:</label>
          <select name="status" id="status" value="{{ old('status', $deal->status) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">ステータスを選択してください</option>
            <option value="prospecting">見込み客発掘</option>
            <option value="eligibility">資格確認</option>
            <option value="needs">ニーズ分析</option>
            <option value="suggestion">提案</option>
            <option value="negotiation">交渉</option>
            <option value="contract">成約</option>
            <option value="lost">失注</option>
          </select>
          <p>{{ $deal->status }}</p>
        </div>
        <div class="mb-4">
          <label for="date" class="block text-white-700 text-sm font-bold mb-2">見込み成約日:</label>
          <input type="date" name="date" id="date" value="{{ old('date', $deal->date) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $deal->date }}</p>
        </div>
        <div class="mb-4">
          <label for="percentage" class="block text-white-700 text-sm font-bold mb-2">確率(%):</label>
          <input type="number" name="percentage" id="percentage" value="{{ old('percentage', $deal->percentage) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $deal->percentage }}</p>
        </div>
        <div class="mb-4">
          <label for="description" class="block text-white-700 text-sm font-bold mb-2">説明:</label>
          <textarea name="description" id="description" rows="4" value="{{ old('description', $deal->description) }}" class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
          <p>{{ $deal->description }}</p>
        </div>
        <div class="mb-4">
          <label for="notes" class="block text-white-700 text-sm font-bold mb-2">備考:</label>
          <textarea name="notes" id="notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('notes', $deal->notes) }}</textarea>
          <p>{{ $deal->notes }}</p>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            更新
          </button>


          <a href="{{ route('deals.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
