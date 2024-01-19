<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Route;

use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PenaltyShortController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Public routes
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    
    
    
    
    Route::resource('/category', CategoryController::class);
    
    // Route::post('/penalty/{loan}', [LoanController::class]);
     Route::resource('/penalty', PenaltyShortController::class);
    
    
     Route::resource('/loan/{loan}/extensions', ExtensionController::class);
     Route::resource('/loan', BookLoanController::class);
    

    Route::resource('/book/{book}/loan/{loan}/penalty', PenaltyController::class);
    Route::resource('/book/{book}/loan', LoanController::class);
    Route::resource('/book', BooksController::class);
    Route::post('/logout', [AuthController::class,'logout']);
});


