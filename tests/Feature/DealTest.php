<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Company;
use App\Models\Contact;

pest()->use(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('商談一覧取得出来てるかの確認', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard/deals');

    $response->assertStatus(200);
});
