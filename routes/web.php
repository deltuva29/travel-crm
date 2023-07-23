<?php

use App\Http\Controllers\API\CalculateDistanceController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Customers\CustomerDashboard;
use App\Http\Livewire\Customers\Profile\CustomerProfileContactsPage;
use App\Http\Livewire\Customers\Profile\CustomerProfilePage;
use App\Http\Livewire\Customers\Profile\CustomerProfileSettingsPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn() => view('home'))->middleware('guest:customer')->name('home');

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', CustomerDashboard::class)->name('customer.dashboard');
    Route::get('/profile', CustomerProfilePage::class)->name('customer.profile');
    Route::get('/profile/settings', CustomerProfileSettingsPage::class)->name('customer.profile.settings');
    Route::get('/profile/edit-contacts', CustomerProfileContactsPage::class)->name('customer.profile.edit-contacts');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::prefix('api')->group(fn() => [
    Route::get('calculate-distance', [CalculateDistanceController::class, 'calculateDistance']),
]);
