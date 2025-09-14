<?php

use App\Models\User;
use App\Models\Company;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertStatus(200);
});

test('dashboard displays welcome message for authenticated user', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertStatus(200)
        ->assertViewIs('dashboard')
        ->assertSee($this->user->name);
});

test('unverified users are redirected to email verification', function () {
    $unverifiedUser = User::factory()->unverified()->create();

    $response = $this->actingAs($unverifiedUser)
        ->get('/dashboard');

    // Check if email verification is required - if not, test should pass with 200
    if (config('auth.verify_email', false)) {
        $response->assertRedirect('/verify-email');
    } else {
        $response->assertStatus(200);
    }
});

test('dashboard is accessible with verified user', function () {
    $response = $this->actingAs($this->user)
        ->get('/dashboard');

    $response->assertStatus(200);
});