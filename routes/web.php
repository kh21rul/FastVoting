<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardEventOptionController;

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

/*
| All of authentication routes are defined with `Auth::routes()`.
|
| Use the list of routes below to see how they are defined:
| - Login page                  : route('login') -> auth/login.blade.php
| - Logout page                 : route('logout')
| - Registration page           : route('register') -> auth/register.blade.php
| - Forget password page        : route('password.request') -> auth/passwords/email.blade.php
| - Reset password page         : route('password.reset') -> auth/passwords/reset.blade.php
| - Email verification page     : route('verification.notice') -> auth/verify.blade.php
*/

Auth::routes(['verify' => true]);

// Go to home page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Go to about page
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::middleware(['auth', 'verified'])->group(function () {
    // === Put all routes that need authentication and email verification here ===
    // Go to dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Go to add new event page
    Route::get('/events/add', [EventController::class, 'add'])
        ->name('event.add');

    // Insert new event
    Route::post('/events/add', [EventController::class, 'create'])
        ->name('event.create');

    Route::middleware('event.authorized')->group(function () {
        // === Put all routes that need event authorization here ===
        // Go to detail event page
        Route::get('/events/{id}', [EventController::class, 'detail'])
            ->name('event.detail');

        // Go to edit event page
        Route::get('/events/{id}/edit', [EventController::class, 'edit'])
            ->name('event.edit');

        // Update the event
        Route::put('/events/{id}/edit', [EventController::class, 'update'])
            ->name('event.update');

        // Go to voters page
        Route::get('/events/{id}/voters', [VoterController::class, 'index'])
            ->name('voters');
    });
});

// TODO: All routes in below is not used the right method and params yet
// Go to vote page
Route::get('/vote', function () {
    return view('pages.vote');
})->name('vote');


// Go to result page
Route::get('/events/eventId/result', function () {
    return view('pages.result');
})->name('result');

// Go to options page
// Route::get('/events/eventId/options', function () {
//     return view('pages.options');
// })->name('options');

Route::resource('/events/options', DashboardEventOptionController::class)->middleware('auth');
