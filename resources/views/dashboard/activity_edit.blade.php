<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動編集フォーム</h2>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach

      @endif

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const companySelect = document.getElementById('company_id');
          const contactSelect = document.getElementById('contact_id');
          const dealSelect = document.getElementById('deal_id');
          const currentContactId = contactSelect.dataset.currentContactId;
          const currentDealId = dealSelect.dataset.currentDealId;

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

          function loadDeals(companyId, selectedId) {
            dealSelect.innerHTML = '<option value="">商談を選択してください</option>';
            if (!companyId) {
              return;
            }

            fetch(`/api/deals/${companyId}`)
              .then(response => response.json())
              .then(data => {
                data.forEach(deal => {
                  const option = document.createElement('option');
                  option.value = deal.id;
                  option.textContent = `${deal.title}`;
                  if (selectedId && String(deal.id) === String(selectedId)) {
                    option.selected = true;
                  }
                  dealSelect.appendChild(option);
                });
              })
              .catch(error => {
                console.error('商談の取得中にエラーが発生しました:', error);
              });
          }

          companySelect.addEventListener('change', function() {
            loadContacts(this.value, null);
          });

          if (companySelect.value) {
            loadContacts(companySelect.value, currentContactId);
          }

          companySelect.addEventListener('change', function() {
            loadDeals(this.value, null);
          });

          if (companySelect.value) {
            loadDeals(companySelect.value, currentDealId);
          }
        });
        </script>

      <form method="POST" action="{{ route('activities.update', $activity->id) }}" class="" >
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="mb-4">
          <label for="company_id" class="block text-white-700 text-sm font-bold mb-2">会社:</label>
          <select name="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}" @selected($company->id == $activity->company_id)>{{ $company->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="contact_id" class="block text-white-700 text-sm font-bold mb-2">連絡先:</label>
          <select name="contact_id" id="contact_id" data-current-contact-id="{{ old('contact_id', $activity->contact_id) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>

          </select>
          <p>{{ $activity->contact_id }}</p>
        </div>
        <div class="mb-4">
          <label for="deal_id" class="block text-white-700 text-sm font-bold mb-2">商談:</label>
          <select name="deal_id" id="deal_id" data-current-contact-id="{{ old('deal_id', $activity->deal_id) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>

          </select>
          <p>{{ $activity->deal_id }}</p>
        </div>
         <div class="mb-4">
          <label for="type" class="block text-white-700 text-sm font-bold mb-2">ステータス:</label>
          <select name="type" id="type" value="{{ old('type', $activity->type) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">タイプを選択してください</option>
            <option value="phone">電話</option>
            <option value="mail">メール</option>
            <option value="meets">会議</option>
            <option value="task">タスク</option>
            <option value="memo">メモ</option>
          </select>
          <p>{{ $activity->type }}</p>
        </div>
        <div class="mb-4">
          <label for="title" class="block text-white-700 text-sm font-bold mb-2">タイトル:</label>
          <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $activity->title }}</p>
        </div>
        <div class="mb-4">
          <label for="description" class="block text-white-700 text-sm font-bold mb-2">説明:</label>
          <textarea name="description" id="description" rows="4" value="{{ old('description', $activity->description) }}" class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
          <p>{{ $activity->description }}</p>
        </div>
        <div class="mb-4">
          <label for="date" class="block text-white-700 text-sm font-bold mb-2">見込み成約日:</label>
          <input type="date" name="date" id="date" value="{{ old('date', $activity->date) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
          <p>{{ $activity->date }}</p>
        </div>
        <div class="mb-4">
          <label for="status" class="block text-white-700 text-sm font-bold mb-2">ステータス:</label>
          <select name="status" id="status" value="{{ old('status', $activity->status) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">ステータスを選択してください</option>
            <option value="schedule">予定</option>
            <option value="completion">完了</option>
            <option value="cancel">キャンセル済み</option>
          </select>
          <p>{{ $activity->status }}</p>
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