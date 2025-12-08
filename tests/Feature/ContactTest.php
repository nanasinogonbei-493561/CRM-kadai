<?php

use App\Models\User;
use App\Models\Company;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('連絡先一覧のテスト', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard/contacts');

    $response->assertStatus(200);
});

