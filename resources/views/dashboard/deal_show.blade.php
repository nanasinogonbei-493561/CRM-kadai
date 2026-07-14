<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>商談詳細ページ</h2>
      <div class="detail-card">

        <div class="mb-4">
          <label class="detail-label">タイトル:</label>
          <p class="detail-value">{{ $deal->title }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">会社名:</label>
          <p class="detail-value">{{ optional($deal->company)->name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">連絡先:</label>
          <p class="detail-value">{{ optional($deal->contact)->first_name }} {{ optional($deal->contact)->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">商談前ステータス:</label>
          <p class="detail-value">{{ $deal->status }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">商談後ステータス:</label>
          <p class="detail-value">{{ $deal->deal_status }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">担当ユーザー:</label>
          <p class="detail-value">{{ optional($deal->user)->name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">商談日:</label>
          <p class="detail-value">{{ $deal->date }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">確度(%):</label>
          <p class="detail-value">{{ $deal->probability }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">説明:</label>
          <p class="detail-value">{{ $deal->description }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">備考:</label>
          <p class="detail-value">{{ $deal->notes }}</p>
        </div>

        <div class="flex items-center gap-4 mt-6">
          <a href="{{ route('deals.edit', $deal->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            編集
          </a>
          <form action="{{ route('deals.destroy', $deal->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">削除</button>
          </form>
          <a href="{{ route('deals.index') }}" class="text-blue-500 hover:underline">一覧へ戻る</a>
        </div>
      </div>
    </div>
</x-layouts.app>
