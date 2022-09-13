<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ComplaintController;
use App\Http\Controllers\API\CaptionController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\WisataController;

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
    Route::post('user', [UserController::class, 'fetch']);
    Route::get('history', [UserController::class, 'history']);
    // Route::post('user', [UserController::class, 'updateProfile']);
    // Route::post('user/photo', [UserController::class, 'updatePhoto']);
    
    // Route::post('complaint', [ComplaintController::class, 'complaint']);
    Route::post('logout', [UserController::class, 'logout']);
});

//ini kan tidak perlu auth
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('complaint', [ComplaintController::class, 'all']);

//ini nanti didelete kalo udah fix
Route::get('caption', [CaptionController::class, 'all']);
Route::post('caption', [CaptionController::class, 'addcaption']);

//Route::get('complaints/{id}', [ComplaintController::class, 'detail']);
// Route::get('detailcomplaint', [ComplaintController::class, 'detail']);
Route::post('complaint', [ComplaintController::class, 'complaint']);

Route::get('article', [ArticleController::class, 'all']);

Route::get('complaintdetail/{id}', [ComplaintController::class, 'complaintdetail']);

//otp request 
Route::post('register2', [UserController::class, 'register2']);
//otp request ulang
Route::post('otprequestulang', [UserController::class, 'otprequestulang']);

Route::post('submitotp', [UserController::class, 'submitotp']);

Route::get('wisata', [WisataController::class, 'all']);

