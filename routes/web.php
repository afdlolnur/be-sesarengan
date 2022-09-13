<?php

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