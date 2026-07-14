<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <h2>会社詳細ページ</h2>
      <div class="detail-card">
        <div class="mb-4">
          <label class="detail-label">会社名:</label>
          <p class="detail-value">{{ $company->name }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">住所:</label>
          <p class="detail-value">{{ $company->address }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">電話番号:</label>
          <p class="detail-value">{{ $company->phone }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">メールアドレス:</label>
          <p class="detail-value">{{ $company->email }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">ウェブサイト:</label>
          <p class="detail-value">{{ $company->website }}</p>
        </div>
        <div class="mb-4">
          <label class="detail-label">説明:</label>
          <p class="detail-value">{{ $company->description }}</p>
        </div>
      </div>
    </div>

</x-layouts.app>