<?php

use App\Models\Gig;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigResponseController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/gigs/{gig}', function (Gig $gig) {
        return view ('gigs.show', ['gig' => $gig]);
    })->name('gigs.show');

    Route::get('/gigs', function () {
        return view ('gigs.index');
    })->name('gigs.index');

    Route::get('/setlists/{gig}', function (Gig $gig) {
        return view ('setlists.show', ['gig' => $gig]);
    })->name('setlists.show');

    Route::get('/songs', function () {
        return view ('songs.index');
    })->name('songs.index');

    // Gig Responses
    Route::get('/gig-responses/accept/{gigResponse}', [GigResponseController::class, 'accept'])
        ->middleware(['signed'])
        ->name('gig-responses.accept');
        
    Route::get('/gig-responses/decline/{gigResponse}', [GigResponseController::class, 'decline'])
        ->middleware(['signed'])
        ->name('gig-responses.decline');

    Route::put('/gig-responses/update', [GigResponseController::class, 'update'])
        ->name('gig-responses.update');
    
});
