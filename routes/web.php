<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailRandomizerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MailController;
use Resources\Views;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return "Hello World";
});

Route::get('/send-mail', [EmailRandomizerController::class, 'sendEmail']);
