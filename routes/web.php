<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('post/create', [PostController::class, 'create']);
Route::post('post', [PostController::class, 'store'])->name('post.store');
Route::get('post/show/{post}', [PostController::class, 'show'])->name('post.show');

Route::prefix('post')->group(function () {
    // コメント作成
    Route::get('{post}/comment/create', [CommentController::class, 'create']);
    Route::post('{post}/comment', [CommentController::class, 'store'])->name('comment.store');

    // コメント削除
    Route::delete('{post}/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
