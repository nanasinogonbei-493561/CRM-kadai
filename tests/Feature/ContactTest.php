<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contact;
use App\Models\User;

pest()->use(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('連絡先のエラー確認', function() {
    $response = $this->actingAs($this->user)
        ->get('/contacts');

    $this->assertDatabaseEmpty('contacts');
});
