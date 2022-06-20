<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\VoteController;

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

/*
| Event routes
| - route('events.index')    -> GET /events                  -> Redirected to "dashboard" page
| - route('events.create')   -> GET /events/create           -> Go to "add new event" page
| - route('events.store')    -> POST /events                 -> Create a new event
| - route('events.show')     -> GET /events/{event}          -> Go to "detail event" page
| - route('events.edit')     -> GET /events/{event}/edit     -> Go to "edit event" page
| - route('events.update')   -> PUT /events/{event}          -> Update an event
| - route('events.destroy')  -> DELETE /events/{event}       -> Delete an event
*/
Route::resource('events', EventController::class)
    ->missing(function () {
        return redirect()->route('events.index')->with('error', 'Event you are looking for does not exist.');
    });

/*
| Option routes
| - route('events.options.create')  -> GET /events/{event}/options/create   -> Go to "add new option" page
| - route('events.options.store')   -> POST /events/{event}/options         -> Create a new option
| - route('options.edit')           -> GET /options/{option}/edit           -> Go to "edit option" page
| - route('options.update')         -> PUT /options/{option}                -> Update an option
| - route('options.destroy')        -> DELETE /options/{option}             -> Delete an option
*/
Route::resource('events.options', OptionController::class)->shallow()
    ->except(['index', 'show']);

/*
| Voter routes
| - route('events.voters.index')   -> GET /events/{event}/voters    -> Go to "voters" page and add new voter form
| - route('events.voters.store')   -> POST /events/{event}/voters   -> Create a new voter
| - route('voters.destroy')        -> DELETE /voters/{voter}        -> Delete a voter
*/
Route::resource('events.voters', VoterController::class)->shallow()
    ->except(['create', 'show', 'edit', 'update']);

// User authentication and email verification middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // === Put all routes that need authentication and email verification here ===
    // Go to dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Get the option image
    Route::get('/option_images/{name}', [OptionController::class, 'getImage'])
        ->name('option.image');

    // Event authorization middleware
    Route::middleware('event.authorized')->group(function () {
        // === Put all routes that need event authorization here ===

        // Event editable middleware.
        Route::middleware('event.editable')->group(function () {
            // === Put all routes that need event editability here ===
            // Commit event
            Route::post('/events/{id}/commit', [EventController::class, 'commit'])
                ->name('event.commit');
        });
    });
});

// Vote authorization middleware
Route::middleware('vote')->group(function () {
    // Go to vote page
    Route::get('/vote/{voterId}', [VoteController::class, 'index'])
        ->name('vote');

    // Save the vote
    Route::post('/vote/{voterId}', [VoteController::class, 'vote'])
        ->name('vote.save');
});

// Go to result page
Route::get('/results/{event}', [VoteController::class, 'result'])
    ->name('result');
