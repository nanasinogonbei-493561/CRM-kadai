<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>連絡先詳細ページ</h2>
      <div class="detail-card">
        <div class="mb-4">
          <label class="detail-label">会社名:</label>
          <p class="detail-value">{{ optional($companies->firstWhere('id', $contact->company_id))->name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">苗字:</label>
          <p class="detail-value">{{ $contact->first_name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">名前:</label>
          <p class="detail-value">{{ $contact->last_name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">役職:</label>
          <p class="detail-value">{{ $contact->position }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">メールアドレス:</label>
          <p class="detail-value">{{ $contact->email }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">電話番号:</label>
          <p class="detail-value">{{ $contact->phone }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">携帯電話番号:</label>
          <p class="detail-value">{{ $contact->mobile }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">メモ:</label>
          <p class="detail-value">{{ $contact->notes }}</p>
        </div>
      </div>
    </div>
</x-layouts.app>
