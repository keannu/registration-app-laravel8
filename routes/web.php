<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('authLoggedInChecker');

Route::middleware('authChecker')->prefix('/dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard.main');

    Route::get('/list', function () {
        return view('dashboard');
    })->name('dashboard.list')->middleware('checkIsAdmin');
});

Route::prefix('api')->group(function () {
    Route::middleware('authChecker')->prefix('/user')->group(function () {
        Route::get('/', [ UserController::class, 'getUserList' ])->middleware('checkIsAdmin');
        Route::get('/logout', [ UserController::class, 'logoutUser' ]);
        Route::get('/current', [ UserController::class, 'getUserByNo' ]);
        Route::put('/{iUserNo}', [ UserController::class, 'updateUser' ]);
        Route::delete('/{iUserNo}', [ UserController::class, 'deleteUser' ]);
    });
    
    Route::middleware('authLoggedInChecker')->prefix('/user')->group(function () {
        Route::post('/login', [ UserController::class, 'loginUser' ]);
        Route::post('/', [ UserController::class, 'createUser' ]);
    });
});