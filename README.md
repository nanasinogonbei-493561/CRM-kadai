# CRM-kadai
## 学習内容・開発期間
 - 開発期間
 - PHPでの、CRUDの書き方について。
 - バリデーションについて。
 - MVCについて。
 - APIの書き方と概念について。
 - WHERE句の検索の書き方について。
 - 構造化ログの設定の仕方について。
 - デプロイについて。
 - その他について。

### 開発期間
 - 2025/9/2から制作開始
 - 2026/2/8現在
   1. 会社、連絡先、商談、活動の4種のCRUDとフィルタリング検索、APIの使用等を実装済み。

### PHHでのCRUDの書き方について。
変数 = 処理
viewに返す。

### バリデーションについて。
```php:php
        //バリデーション
        $validated = $request->validate([
            'company_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ],[
            'company_id.required' => '会社IDは必須です。',
        ]);

        //ログインしているユーザーのIDを追加

        $validated['user_id'] = auth()->id();


        // dd($validated);
        //連絡先を作成
        \App\Models\Contact::create($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact created successfull');
```

### MVCについて。
Model: データの情報を保持する。（DBなど）
View: Controllerで返ってきた情報をviewに返す
Controller: ModelとViewを繋ぐ架け橋

### APIの書き方。
 - そもそもAPIとは？
 APIは、アプリとアプリを繋ぐコンセント的な役割。
  - 書き方
  フロント側でAPI呼び出す際のコードを書き、バック側でAPIの処理を書く

### WHERE句について
Laravelの公式ドキュメントを検索して、読んで実装しました。

### 構造化ログについて。
Laravelの公式ドキュメントを検索して、読んで実装しました。

### デプロイについて。
Conoha VPSからデプロイしました。
はじめにアップデートした後、PHP-FPMとcomposerとNginxをインストールし、DNSを設定した後、CerbotでSSL化しました。
その後、ログイン画面が出なかったので、npm run devしてなかったのが原因だと突き止め、バグ直しました。

### その他について
学習したものをZennのscrapにて記事にしました。

https://zenn.dev/nanashinogonbei/scraps/f7066c71845886
