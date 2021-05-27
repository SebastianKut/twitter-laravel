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

    Route::delete('/tweet/{tweet}/delete', [App\Http\Controllers\TweetController::class, 'destroy'])->name('delete/tweet')
        ->middleware('can:destroy,tweet');

    Route::get('/profile/{user:username}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');

    Route::get('/profile/{user:username}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile/edit')
        ->middleware('can:edit,user'); //syntax is middleware(can:functionNameFromUserPolicy,{wildcard})

    Route::patch('/profile/{user:username}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile/update')
        ->middleware('can:edit,user');

    Route::post('/profile/{user:username}/follow', [App\Http\Controllers\FollowController::class, 'store'])
        ->middleware('can:follow,user');;

    Route::get('/explore', [App\Http\Controllers\ExploreController::class, 'index'])->name('explore');

    Route::post('/tweet/{tweet}/like', [App\Http\Controllers\TweetLikesController::class, 'store'])->name('like/tweet');

    Route::delete('/tweet/{tweet}/like', [App\Http\Controllers\TweetLikesController::class, 'destroy'])->name('dislike/tweet');

    Route::post('/tweet/{tweet}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('make/comment');

    Route::delete('/tweet/{comment}/comment', [App\Http\Controllers\CommentController::class, 'destroy'])->name('delete/comment')
        ->middleware('can:destroy,comment');
});

Auth::routes();
