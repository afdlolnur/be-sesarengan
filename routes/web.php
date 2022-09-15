<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\CaptionController;
use App\Http\Controllers\YajraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintController;
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

// Homepage
Route::get('/', function () {
    return redirect()->route('dashboard');
});

//test halaman error
// Route::get('/403', function () {
//     return view('errors.403');
// });
// Route::get('/500', function () {
//     return view('errors.500');
// });
// Route::get('/404', function () {
//     return view('errors.404');
// });

// Dashboard
Route::prefix('dashboard')
    ->middleware(['auth:sanctum','admin'])
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('complaints', ComplaintController::class);        
    });

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//CRUD CAPTION
Route::get('caption.data', [CaptionController::class, 'data'])->name('caption.data');
Route::get('caption', [CaptionController::class, 'index'])->name('caption');
Route::post('caption.store', [CaptionController::class, 'store'])->name('caption.store');
Route::post('caption.edit', [CaptionController::class, 'edit'])->name('caption.edit');
Route::post('caption.update', [CaptionController::class, 'update'])->name('caption.update');
Route::post('caption.delete', [CaptionController::class, 'delete'])->name('caption.delete');

//CRUD USERS
Route::get('user.data', [UserController::class, 'data'])->name('user.data');
Route::get('user', [UserController::class, 'index'])->name('user');
// Route::post('user.store', [UserController::class, 'store'])->name('user.store');
// Route::post('caption.edit', [CaptionController::class, 'edit'])->name('caption.edit');
// Route::post('caption.update', [CaptionController::class, 'update'])->name('caption.update');
Route::post('user.delete', [UserController::class, 'delete'])->name('user.delete');

//CRUD WISATA
Route::get('wisata.data', [WisataController::class, 'data'])->name('wisata.data');
Route::get('wisata', [WisataController::class, 'index'])->name('wisata');
Route::post('wisata.store', [WisataController::class, 'store'])->name('wisata.store');
Route::post('wisata.edit', [WisataController::class, 'edit'])->name('wisata.edit');
Route::post('wisata.update', [WisataController::class, 'update'])->name('wisata.update');
Route::post('wisata.delete', [WisataController::class, 'delete'])->name('wisata.delete');

//CRUD ARTIKEL
Route::get('article.data', [ArticleController::class, 'data'])->name('article.data');
Route::get('article', [ArticleController::class, 'index'])->name('article');
Route::post('article.store', [ArticleController::class, 'store'])->name('article.store');
Route::post('article.edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::post('article.update', [ArticleController::class, 'update'])->name('article.update');
Route::post('article.delete', [ArticleController::class, 'delete'])->name('article.delete');

//CRUD COMPLAINT
