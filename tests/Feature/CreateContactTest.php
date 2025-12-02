<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contact;
use function Pest\Laravel\{post, assertDatabaseHas, assertDatabaseCount};

// RefreshDatabase トレイトを使用する場合
uses(RefreshDatabase::class);

test('連絡先が正常に作成され、データベースに保存されること', function () {
    // 1. テストデータの準備
    $contactData = [
        'name' => 'テストユーザー',
        'email' => 'test@example.com',
        'message' => 'これはテストメッセージです。',
    ];

    // 2. 新規作成エンドポイントへのPOSTリクエスト送信
    // この例では、連絡先を保存するルートが '/contacts' であり、
    // ContactController の store メソッドにルーティングされていると想定しています。
    $response = post('/contacts', $contactData);

    // 3. レスポンスの検証
    // 成功した場合は、通常、リダイレクトされます (例: ステータスコード 302)。
    $response->assertStatus(302);
    // または、連絡先一覧ページなどにリダイレクトされたことを確認します。
    $response->assertRedirect('/contacts');

    // 4. データベースの状態の検証
    // 指定したデータが contacts テーブルに存在することを確認します。
    assertDatabaseHas('contacts', [
        'name' => 'テストユーザー',
        'email' => 'test@example.com',
        'message' => 'これはテストメッセージです。',
    ]);

    // contacts テーブルのレコード数が1件増えていることを確認します。
    assertDatabaseCount('contacts', 1);

    // フラッシュメッセージがセッションに保存されていることを確認することもできます。
    $response->assertSessionHas('success', '連絡先が正常に作成されました。');
});

test('バリデーションエラー時に連絡先が作成されないこと', function () {
    // 不正なデータ（例: email形式が間違っている）
    $invalidData = [
        'name' => 'テストユーザー',
        'email' => 'invalid-email',
        'message' => '無効なデータです。',
    ];

    $response = post('/contacts', $invalidData);

    // バリデーションエラー時は元のフォームページに戻る (ステータスコード 302 または 422)
    $response->assertStatus(302);
    // セッションにエラーメッセージが含まれていることを確認
    $response->assertSessionHasErrors(['email']);

    // データベースにレコードが作成されていないことを確認
    assertDatabaseCount('contacts', 0);
});
