<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Company;
use App\Models\Contact;

pest()->use(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('連絡先一覧のテスト', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard/contacts');

    $response->assertStatus(200);
});

test('連絡先のエラー確認', function() {
    $response = $this->actingAs($this->user)
        ->get('/contacts');

    $this->assertDatabaseEmpty('contacts');
});