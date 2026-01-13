<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動作成フォーム</h2>
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

          companySelect.addEventListener('change', function() {
            console.log('会社選択が変更されました。');
            const companyId = this.value;
            console.log('選択された会社ID:', companyId);

            // 連絡先ドロップダウンをクリア
            contactSelect.innerHTML = '<option value="">連絡先を選択してください</option>';
            if (companyId) {
              // 会社IDに基づいて連絡先を取得するAPIエンドポイントにリクエストを送信
              fetch(`/api/contacts/${companyId}`)
               .then(response => response.json())
               .then(data => {
                console.log('取得した連絡先データ:', data);
                data.forEach(contact => {
                 console.log('連絡先:', contact);
                 const option = document.createElement('option');
                 option.value = contact.id;
                 option.textContent = `${contact.first_name} ${contact.last_name}`;

                 contactSelect.appendChild(option);
                });
               })
               .catch(error => {
                console.error('連絡先の取得中にエラーが発生しました:', error);
               });
            }
            
            dealSelect.innerHTML = '<option value="">商談を選択してください</option>';
            if (companyId) {
              // 会社IDに基づいて連絡先を取得するAPIエンドポイントにリクエストを送信
              fetch(`/api/deals/${companyId}`)
               .then(response => response.json())
               .then(data => {
                console.log('取得した商談先データ:', data);
                data.forEach(deal => {
                 console.log('商談:', deal);
                 const option = document.createElement('option');
                 option.value = deal.id;
                 option.textContent = `${deal.title}`;

                 dealSelect.appendChild(option);
                });
               })
               .catch(error => {
                console.error('商談の取得中にエラーが発生しました:', error);
               });
            }
            
          });
        });
      </script>

      <form method="POST" action="{{ route('activities.store') }}" class="" >
        @csrf

        <div class="mb-4">
          <label for="company_id" class="block text-white-700 text-sm font-bold mb-2">会社:</label>
          <select name="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">会社を選択してください</option>
            @foreach($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>
        </div>
        
        @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
      @endif
      
        <div class="mb-4">
          <label for="contact_id" class="block text-white-700 text-sm font-bold mb-2">連絡先:</label>
          <select name="contact_id" id="contact_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>

          </select>
        </div>
        <div class="mb-4">
          <label for="deal_id" class="block text-white-700 text-sm font-bold mb-2">商談:</label>
          <select name="deal_id" id="deal_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>

          </select>
        </div>
        <div class="mb-4">
          <label for="type" class="block text-white-700 text-sm font-bold mb-2">タイプ:</label>
          <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">タイプを選択してください</option>
            <option value="phone">電話</option>
            <option value="mail">メール</option>
            <option value="meets">会議</option>
            <option value="task">タスク</option>
            <option value="memo">メモ</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="title" class="block text-white-700 text-sm font-bold mb-2">タイトル:</label>
          <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="description" class="block text-white-700 text-sm font-bold mb-2">説明:</label>
          <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
        </div>
        <div class="mb-4">
          <label for="date" class="block text-white-700 text-sm font-bold mb-2">見込み成約日:</label>
          <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="status" class="block text-white-700 text-sm font-bold mb-2">ステータス:</label>
          <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="">ステータスを選択してください</option>
            <option value="schedule">予定</option>
            <option value="completion">完了</option>
            <option value="cancel">キャンセル済み</option>
          </select>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作成
          </button>

          <a href="{{ route('activities.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>

</x-layouts.app>