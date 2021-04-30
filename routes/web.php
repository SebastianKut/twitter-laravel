<?php

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

Route::get('/', function () {
    return view('welcome');
});
// When you put {user:name} in the wildcard and not just {user} it tells laravel to serach by name column and not default id column
Route::middleware('auth')->group(function () {
    Route::post('/tweets', [App\Http\Controllers\TweetController::class, 'store']);
    Route::get('/tweets', [App\Http\Controllers\TweetController::class, 'index'])->name('home');
    Route::get('/profile/{user:name}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/{user:name}/follow', [App\Http\Controllers\FollowController::class, 'store']);
});

Auth::routes();
