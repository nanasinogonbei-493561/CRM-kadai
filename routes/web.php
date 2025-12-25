<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiContactController;

Route::get('/home', [HomeController::class, 'index']);



Route::get('/', function () {
    return view('welcome');
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

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/api/contacts/{companyId}', [\App\Http\Controllers\ApiContactController::class, 'getConctactsByCompnay']);



require __DIR__.'/auth.php';
