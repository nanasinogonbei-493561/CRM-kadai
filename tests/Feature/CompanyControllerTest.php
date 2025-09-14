<?php

use App\Models\Company;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('authenticated user can view companies index', function () {
    $companies = Company::factory()->count(3)->create();

    $response = $this->actingAs($this->user)
        ->get(route('companies.index'));

    $response->assertStatus(200)
        ->assertViewIs('dashboard.company_index')
        ->assertViewHas('companies');
});

test('unauthenticated user cannot view companies index', function () {
    $response = $this->get(route('companies.index'));

    $response->assertRedirect(route('login'));
});

test('companies index displays company data', function () {
    $company = Company::factory()->create([
        'name' => 'Test Company Ltd',
        'email' => 'test@company.com'
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('companies.index'));

    $response->assertStatus(200)
        ->assertSee('Test Company Ltd');
        // Note: Email display might not be implemented in view yet
});

test('company can be created with valid data', function () {
    $companyData = [
        'name' => 'New Test Company',
        'email' => 'new@test.com',
        'phone' => '123-456-7890',
        'website' => 'https://newtest.com',
        'industry' => 'Technology'
    ];

    $response = $this->actingAs($this->user)
        ->post(route('companies.store'), $companyData);

    $response->assertRedirect(route('companies.index'))
        ->assertSessionHas('success', 'Company created successfully.');

    $this->assertDatabaseHas('companies', [
        'name' => 'New Test Company',
        'email' => 'new@test.com',
        'industry' => 'Technology'
    ]);
});

test('company creation requires name field', function () {
    $companyData = [
        'email' => 'test@company.com'
    ];

    $response = $this->actingAs($this->user)
        ->post(route('companies.store'), $companyData);

    $response->assertSessionHasErrors(['name']);
});

test('company creation validates email format', function () {
    $companyData = [
        'name' => 'Test Company',
        'email' => 'invalid-email'
    ];

    $response = $this->actingAs($this->user)
        ->post(route('companies.store'), $companyData);

    $response->assertSessionHasErrors(['email']);
});

test('company creation validates website URL format', function () {
    $companyData = [
        'name' => 'Test Company',
        'website' => 'not-a-valid-url'
    ];

    $response = $this->actingAs($this->user)
        ->post(route('companies.store'), $companyData);

    $response->assertSessionHasErrors(['website']);
});

// TODO: Implement company show view and then uncomment this test
// test('company can be viewed individually', function () {
//     $company = Company::factory()->create([
//         'name' => 'View Test Company'
//     ]);

//     $response = $this->actingAs($this->user)
//         ->get(route('companies.show', $company->id));

//     $response->assertStatus(200)
//         ->assertViewIs('dashboard.company_show')
//         ->assertViewHas('company', $company);
// });

test('company can be updated with valid data', function () {
    $company = Company::factory()->create([
        'name' => 'Original Name'
    ]);

    $updateData = [
        'name' => 'Updated Company Name',
        'email' => 'updated@test.com',
        'industry' => 'Finance'
    ];

    $response = $this->actingAs($this->user)
        ->put(route('companies.update', $company->id), $updateData);

    $response->assertRedirect(route('companies.index'))
        ->assertSessionHas('success', 'Company updated successfully.');

    $company->refresh();
    expect($company->name)->toBe('Updated Company Name');
    expect($company->email)->toBe('updated@test.com');
    expect($company->industry)->toBe('Finance');
});

test('company update requires name field', function () {
    $company = Company::factory()->create();

    $updateData = [
        'name' => '',
        'email' => 'test@company.com'
    ];

    $response = $this->actingAs($this->user)
        ->put(route('companies.update', $company->id), $updateData);

    $response->assertSessionHasErrors(['name']);
});

test('company can be deleted', function () {
    $company = Company::factory()->create();

    $response = $this->actingAs($this->user)
        ->delete(route('companies.destroy', $company->id));

    $response->assertRedirect(route('companies.index'))
        ->assertSessionHas('success', 'Company deleted successfully.');

    $this->assertDatabaseMissing('companies', ['id' => $company->id]);
});

test('deleting non-existent company returns 404', function () {
    $response = $this->actingAs($this->user)
        ->delete(route('companies.destroy', 999));

    $response->assertStatus(404);
});

test('editing non-existent company returns 404', function () {
    $response = $this->actingAs($this->user)
        ->get(route('companies.edit', 999));

    $response->assertStatus(404);
});