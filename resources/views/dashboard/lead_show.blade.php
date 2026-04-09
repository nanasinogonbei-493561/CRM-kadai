<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>リード詳細</h2>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">会社名:</label>
          <p class="text-gray-900">{{ $lead->company_name }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">担当者名:</label>
          <p class="text-gray-900">{{ $lead->contact_name }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メールアドレス:</label>
          <p class="text-gray-900">{{ $lead->email }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">電話番号:</label>
          <p class="text-gray-900">{{ $lead->phone }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">電話NG:</label>
          <p class="text-gray-900">{{ $lead->phone_ng ? 'はい' : 'いいえ' }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ランク:</label>
          <p class="text-gray-900">{{ $lead->rank }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">状況:</label>
          <p class="text-gray-900">{{ $lead->status }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">商談後ステータス:</label>
          <p class="text-gray-900">{{ $lead->deal_status }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">最終営業状況:</label>
          <p class="text-gray-900">{{ $lead->last_sales_status }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">メール備考:</label>
          <p class="text-gray-900">{{ $lead->email_notes }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">着電日報備考:</label>
          <p class="text-gray-900">{{ $lead->call_notes }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">備考:</label>
          <p class="text-gray-900">{{ $lead->notes }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">登録者:</label>
          <p class="text-gray-900">{{ optional($lead->user)->name }}</p>
        </div>

        <div class="flex items-center gap-4 mt-6">
          <a href="{{ route('leads.edit', $lead->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            編集
          </a>
          <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">削除</button>
          </form>
          <a href="{{ route('leads.index') }}" class="text-blue-500 hover:underline">一覧へ戻る</a>
        </div>
      </div>
    </div>
</x-layouts.app>
