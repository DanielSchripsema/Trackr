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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/API/emailSender={sender}&emailRecipient={recipient}&SenderCountry{SenderCountry}&SenderStreetName{SenderStreetName}&SenderHouseNumber{SenderHouseNumber}&SenderPostalCode{SenderPostalCode}&SenderCity{SenderCity}&RecipientCountry{RecipientCountry}&RecipientStreetName{RecipientStreetName}&RecipientHouseNumber{RecipientHouseNumber}&RecipientPostalCode{RecipientPostalCode}&RecipientCity{RecipientCity}
', [App\Http\Controllers\APIController::class, 'insert'])->name('insert');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
