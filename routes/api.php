<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ComplaintController;
use App\Http\Controllers\API\CaptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    //disini route yang harus login dulu
    Route::get('user', [UserController::class, 'fetch']);
    // Route::post('user', [UserController::class, 'updateProfile']);
    // Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('complaint', [ComplaintController::class, 'complaint']);
    Route::post('complaint/{id}', [ComplaintController::class, 'detail']);
    Route::post('logout', [UserController::class, 'logout']);
});

//ini kan tidak perlu auth
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('complaint', [ComplaintController::class, 'all']);

Route::get('caption', [CaptionController::class, 'all']);
Route::post('caption', [CaptionController::class, 'addcaption']);




