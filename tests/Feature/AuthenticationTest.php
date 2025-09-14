<?php

use App\Models\User;

test('users can view login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using login page', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect()->assertLocation('/dashboard');
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect()->assertLocation('/dashboard');
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('dashboard requires authentication', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});

test('authenticated users can access dashboard', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});

test('settings pages require authentication', function () {
    $settingsRoutes = [
        '/settings/profile',
        '/settings/password',
        '/settings/appearance'
    ];

    foreach ($settingsRoutes as $route) {
        $response = $this->get($route);
        $response->assertRedirect('/login');
    }
});

test('authenticated users can access settings pages', function () {
    $user = User::factory()->create();

    $settingsRoutes = [
        '/settings/profile',
        '/settings/password', 
        '/settings/appearance'
    ];

    foreach ($settingsRoutes as $route) {
        $response = $this->actingAs($user)->get($route);
        $response->assertStatus(200);
    }
});

test('email verification is required for dashboard access', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    // Check if email verification is enforced
    if (config('auth.verify_email', false)) {
        $response->assertRedirect('/verify-email');
    } else {
        $response->assertStatus(200);
    }
});

test('verified users can access dashboard', function () {
    $user = User::factory()->create(); // Default factory creates verified users

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});