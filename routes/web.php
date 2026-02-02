<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index']);


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//会社管理のルート
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/companies', [\App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('dashboard/companies/create', [\App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('dashboard/companies', [\App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('dashboard/companies/{id}', [\App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
    Route::get('dashboard/companies/{id}/edit', [\App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('dashboard/companies/{id}', [\App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('dashboard/companies/{id}', [\App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');

});

Route::middleware(['auth'])->group(function (){
    Route::get('dashboard/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
    Route::get('dashboard/contacts/create', [\App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
    Route::post('dashboard/contacts', [\App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
    Route::get('dashboard/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'show'])->name('contacts.show');
    Route::get('dashboard/contacts/{id}/edit', [\App\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('dashboard/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'update'])->name('contacts.update');
    Route::delete('dashboard/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::get('dashboard/deals', [\App\Http\Controllers\DealController::class, 'index'])->name('deals.index');
    Route::get('dashboard/deals/create', [\App\Http\Controllers\DealController::class, 'create'])->name('deals.create');
    Route::post('dashboard/deals', [\App\Http\Controllers\DealController::class, 'store'])->name('deals.store');
    Route::get('dashboard/deals/{id}', [\App\Http\Controllers\DealController::class, 'show'])->name('deals.show');
    Route::get('dashboard/deals/{id}/edit', [\App\Http\Controllers\DealController::class, 'edit'])->name('deals.edit');
    Route::put('dashboard/deals/{id}', [\App\Http\Controllers\DealController::class, 'update'])->name('deals.update');
    Route::delete('dashboard/deals/{id}', [\App\Http\Controllers\DealController::class, 'destroy'])->name('deals.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::get('dashboard/activities', [\App\Http\Controllers\ActivityController::class, 'index'])->name('activities.index');
    Route::get('dashboard/activities/create', [\App\Http\Controllers\ActivityController::class, 'create'])->name('activities.create');
    Route::post('dashboard/activities', [\App\Http\Controllers\ActivityController::class, 'store'])->name('activities.store');
    Route::get('dashboard/activities/{id}', [\App\Http\Controllers\ActivityController::class, 'show'])->name('activities.show');
    Route::get('dashboard/activities/{id}/edit', [\App\Http\Controllers\ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('dashboard/activities/{id}', [\App\Http\Controllers\ActivityController::class, 'update'])->name('activities.update');
    Route::delete('dashboard/activities/{id}', [\App\Http\Controllers\ActivityController::class, 'destroy'])->name('activities.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::get('dashboard/activiteis', [\App\Http\Controllers\ActivityController::class, 'index'])->name('activiteis.index');
    Route::get('dashboard/activiteis/create', [\App\Http\Controllers\ActivityController::class, 'create'])->name('activiteis.create');
    Route::post('dashboard/activiteis', [\App\Http\Controllers\ActivityController::class, 'store'])->name('activiteis.store');
    Route::get('dashboard/activiteis/{id}', [\App\Http\Controllers\ActivityController::class, 'show'])->name('activiteis.show');
    Route::get('dashboard/activiteis/{id}/edit', [\App\Http\Controllers\ActivityController::class, 'edit'])->name('activiteis.edit');
    Route::put('dashboard/activiteis/{id}', [\App\Http\Controllers\ActivityController::class, 'update'])->name('activiteis.update');
    Route::delete('dashboard/activiteis/{id}', [\App\Http\Controllers\ActivityController::class, 'destroy'])->name('activiteis.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/api/contacts/{companyId}', [\App\Http\Controllers\ApiContactController::class, 'getContactsByCompany']);
Route::get('/api/deals/{companyId}', [\App\Http\Controllers\ApiDealController::class, 'getDealsByCompany']);

Route::get('/companies', [HomeController::class, 'search']);

require __DIR__.'/auth.php';
