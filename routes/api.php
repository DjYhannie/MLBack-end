<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailRandomizerController;
use App\Models\EmailRandomizer;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){

    Route::post('/emails', [EmailRandomizerController::class, 'selectedMails']);

    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('logout/{id}', [UserController::class, 'logout']);

});


Route::get('/email', [EmailRandomizerController::class, 'getAllMails']);
Route::get('sendEmail', [EmailRandomizerController::class, 'sendEmail']);
// Route::post('/emails', [EmailRandomizerController::class, 'selectedMails']);





