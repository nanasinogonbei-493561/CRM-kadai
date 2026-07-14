<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>活動詳細ページ</h2>
      <div class="detail-card">

        <div class="mb-4">
          <label class="detail-label">会社名:</label>
          <p class="detail-value">{{ optional($activity->company)->name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">連絡先:</label>
          <p class="detail-value">{{ optional($activity->contact)->first_name }} {{ optional($activity->contact)->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">商談:</label>
          <p class="detail-value">{{ optional($activity->deal)->title }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">種別:</label>
          <p class="detail-value">{{ $activity->type }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">タイトル:</label>
          <p class="detail-value">{{ $activity->title }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">説明:</label>
          <p class="detail-value">{{ $activity->description }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">活動日:</label>
          <p class="detail-value">{{ $activity->date }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">ステータス:</label>
          <p class="detail-value">{{ $activity->status }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">電話NG:</label>
          <p class="detail-value">{{ $activity->phone_ng ? 'はい' : 'いいえ' }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">最終営業状況:</label>
          <p class="detail-value">{{ $activity->last_sales_status }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">メール備考:</label>
          <p class="detail-value">{{ $activity->email_notes }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">着電日報備考:</label>
          <p class="detail-value">{{ $activity->call_notes }}</p>
        </div>

        <div class="flex items-center gap-4 mt-6">
          <a href="{{ route('activities.edit', $activity->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            編集
          </a>
          <a href="{{ route('activities.index') }}" class="text-blue-500 hover:underline">一覧へ戻る</a>
        </div>
      </div>
    </div>
</x-layouts.app>
