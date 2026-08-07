<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Books
|--------------------------------------------------------------------------
*/

Route::resource('books', BookController::class);


/*
|--------------------------------------------------------------------------
| Members
|--------------------------------------------------------------------------
*/

Route::resource('members', MemberController::class);


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::resource('categories', CategoryController::class)
    ->only(['index', 'store', 'update', 'destroy']);


/*
|--------------------------------------------------------------------------
| Borrowings
|--------------------------------------------------------------------------
*/

Route::resource('borrowings', BorrowingController::class)
    ->only([
        'index',
        'store',
        'edit',
        'update',
        'destroy',
        'show',
    ]);

/*
|--------------------------------------------------------------------------
| Returns
|--------------------------------------------------------------------------
*/

Route::get('/returns', [ReturnController::class, 'index'])
    ->name('returns.index');

Route::post('/returns/{borrowing}', [ReturnController::class, 'store'])
    ->name('returns.store');


/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');


/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/

Route::get('/settings', [SettingController::class, 'index'])
    ->name('settings.index');


// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
