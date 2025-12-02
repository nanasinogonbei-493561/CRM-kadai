<?php

use App\Models\User;
use App\Models\Company;
use App\Models\Contact;

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('会社一蘭の確認テスト', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertStatus(200);
});

test('会社一覧の確認テスト1', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertSee('会社一覧');
});

test('連絡先一覧の確認テスト', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertSee('連絡先一覧');
});

test('dashboard1の確認テスト', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard1');

    $response->assertStatus(404);
});

// test('Json出力されてるか確認', function () {
//     $response = $this->postJson('/dashboard/contact', ['id' => '1']);

//     $response
//         ->assertStatus(200);
// });

// test('連絡先の新規作成の動作確認', function () {
//     $response = $this->getJson(fn (AssertableJson $json) => 
//     $json->has('id')
// );
// });

// test('連絡先の新規作成の動作確認', function () {
//     $user = User::factory()->create();
 
//     $response = $this->actingAs($user)
//         ->withSession(['banned' => false])
//         ->get('/');

//     $response->assertStatus(404);
// });
