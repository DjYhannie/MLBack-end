<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailRandomizerController;
use App\Models\Admin;
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

    Route::get('/users', [UserController::class, 'getUsers']);

    Route::get('/email', [EmailRandomizerController::class, 'getAllMails']);
    Route::post('/emails', [EmailRandomizerController::class, 'selectedMails']);
    Route::get('/test', [EmailRandomizerController::class, 'sendTestNotification']);




    //Admin
    Route::post('/adminforms', [AdminController::class, 'adminSelectedMails']);



    Route::post('logout/{id}', [UserController::class, 'logout']);

});


Route::post('/forms', [EmailRandomizerController::class, 'addDataForms']);
Route::get('/responses', [AdminController::class, 'getResposes']);
Route::get('sendEmail', [EmailRandomizerController::class, 'sendEmail']);
// Route::post('/emails', [EmailRandomizerController::class, 'selectedMails']);







