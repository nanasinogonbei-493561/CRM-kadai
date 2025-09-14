<?php

use App\Models\Company;

test('company can be created with required fields', function () {
    $company = Company::factory()->create([
        'name' => 'Test Company'
    ]);

    expect($company->name)->toBe('Test Company');
    expect($company->exists)->toBeTrue();
});

test('company can be created with all fields', function () {
    $companyData = [
        'name' => 'Full Test Company',
        'email' => 'test@company.com',
        'phone' => '123-456-7890',
        'website' => 'https://test.com',
        'address' => '123 Test St',
        'postal_code' => '12345',
        'city' => 'Test City',
        'industry' => 'Technology',
        'description' => 'A test company',
        'notes' => 'Test notes'
    ];

    $company = Company::factory()->create($companyData);

    expect($company->name)->toBe('Full Test Company');
    expect($company->email)->toBe('test@company.com');
    expect($company->phone)->toBe('123-456-7890');
    expect($company->website)->toBe('https://test.com');
    expect($company->industry)->toBe('Technology');
});

test('company fillable fields are correctly set', function () {
    $expectedFillable = [
        'name',
        'email',
        'phone',
        'website',
        'address',
        'postal_code',
        'city',
        'industry',
        'description',
        'notes',
    ];

    $company = new Company();
    expect($company->getFillable())->toBe($expectedFillable);
});

test('company factory creates valid data', function () {
    $company = Company::factory()->make();

    expect($company->name)->toBeString();
    expect($company->email)->toMatch('/^[^@\s]+@[^@\s]+\.[^@\s]+$/');
    expect($company->industry)->toBeIn([
        'Technology',
        'Healthcare', 
        'Finance',
        'Education',
        'Manufacturing',
        'Retail',
        'Real Estate',
        'Consulting'
    ]);
});

test('company factory minimal state works', function () {
    $company = Company::factory()->minimal()->make();

    expect($company->name)->toBeString();
    expect($company->email)->toBeNull();
    expect($company->phone)->toBeNull();
    expect($company->website)->toBeNull();
    expect($company->industry)->toBeNull();
});

test('company timestamps are automatically managed', function () {
    $company = Company::factory()->create();

    expect($company->created_at)->not->toBeNull();
    expect($company->updated_at)->not->toBeNull();
    expect($company->created_at)->toEqual($company->updated_at);
});