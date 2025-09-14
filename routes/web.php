<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});



require __DIR__.'/auth.php';
