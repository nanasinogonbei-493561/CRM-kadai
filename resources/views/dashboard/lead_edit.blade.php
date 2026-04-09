<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>リード編集</h2>

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="text-red-600">{{ $error }}</div>
        @endforeach
      @endif

      <form method="POST" action="{{ route('leads.update', $lead->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label for="company_name" class="block text-white-700 text-sm font-bold mb-2">会社名 <span class="text-red-500">*</span></label>
          <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $lead->company_name) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
          <label for="contact_name" class="block text-white-700 text-sm font-bold mb-2">担当者名</label>
          <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $lead->contact_name) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
          <label for="email" class="block text-white-700 text-sm font-bold mb-2">メールアドレス</label>
          <input type="email" name="email" id="email" value="{{ old('email', $lead->email) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
          <label for="phone" class="block text-white-700 text-sm font-bold mb-2">電話番号</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone', $lead->phone) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4 flex items-center gap-2">
          <input type="checkbox" name="phone_ng" id="phone_ng" value="1"
            {{ old('phone_ng', $lead->phone_ng) ? 'checked' : '' }}>
          <label for="phone_ng" class="text-white-700 text-sm font-bold">電話NG</label>
        </div>

        <div class="mb-4">
          <label for="rank" class="block text-white-700 text-sm font-bold mb-2">ランク</label>
          <select name="rank" id="rank"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">選択してください</option>
            @foreach(['A','B','C'] as $r)
              <option value="{{ $r }}" @selected(old('rank', $lead->rank) === $r)>{{ $r }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="status" class="block text-white-700 text-sm font-bold mb-2">状況</label>
          <input type="text" name="status" id="status" value="{{ old('status', $lead->status) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
          <label for="deal_status" class="block text-white-700 text-sm font-bold mb-2">商談後ステータス</label>
          <select name="deal_status" id="deal_status"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">選択してください</option>
            @foreach(['成約','検討','商談設定中'] as $ds)
              <option value="{{ $ds }}" @selected(old('deal_status', $lead->deal_status) === $ds)>{{ $ds }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="last_sales_status" class="block text-white-700 text-sm font-bold mb-2">最終営業状況</label>
          <textarea name="last_sales_status" id="last_sales_status" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('last_sales_status', $lead->last_sales_status) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="email_notes" class="block text-white-700 text-sm font-bold mb-2">メール備考</label>
          <textarea name="email_notes" id="email_notes" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('email_notes', $lead->email_notes) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="call_notes" class="block text-white-700 text-sm font-bold mb-2">着電日報備考</label>
          <textarea name="call_notes" id="call_notes" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('call_notes', $lead->call_notes) }}</textarea>
        </div>

        <div class="mb-4">
          <label for="notes" class="block text-white-700 text-sm font-bold mb-2">備考</label>
          <textarea name="notes" id="notes" rows="4"
            class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('notes', $lead->notes) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            更新
          </button>
          <a href="{{ route('leads.index') }}" class="text-blue-500 hover:underline">キャンセル</a>
        </div>
      </form>
    </div>
</x-layouts.app>
