<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/dashboard/outgoing-packages', [PackageController::class, 'outgoingPackages'])
	->middleware(['auth'])->name('outgoing-packages');

Route::get('/dashboard/incoming-packages', [PackageController::class, 'incomingPackages'])
	->middleware(['auth'])->name('incoming-packages');

Route::post('/dashboard/print-lables', [PackageController::class, 'printLables'])
	->middleware(['auth'])->name('print-lables');

Route::get('/dashboard/review-delivery/{packageId}', [ReviewController::class, 'create'])
	->middleware(['auth'])->name('review-delivery');

Route::post('/dashboard/add-delivery-review', [ReviewController::class, 'store'])
	->middleware(['auth'])->name('add-delivery-review');

Route::get('/package/{id}', [PackageController::class, 'getGuestPackage'])
	->name('guest-package');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/API/emailSender={sender}&emailRecipient={recipient}&SenderCountry{SenderCountry}&SenderStreetName{SenderStreetName}&SenderHouseNumber{SenderHouseNumber}&SenderPostalCode{SenderPostalCode}&SenderCity{SenderCity}&RecipientCountry{RecipientCountry}&RecipientStreetName{RecipientStreetName}&RecipientHouseNumber{RecipientHouseNumber}&RecipientPostalCode{RecipientPostalCode}&RecipientCity{RecipientCity}&FirstnameSender{FirstnameSender}&LastnameSender&{LastnameSender}&FirstnameRecipient{FirstnameRecipient}&LastnameRecipient{LastnameRecipient}
', [App\Http\Controllers\APIController::class, 'insert'])->name('insert');

Route::get('/API/Changepackage{packageID}To{status}', [App\Http\Controllers\APIController::class, 'ChangeStatus'])->name('ChangeStatus');

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'index'])
	->middleware(['auth']);

Route::get('/dashboard/pick-up-plan-system', [AdminController::class, 'pickUpPlanSystem'])
    ->middleware(['auth'])->name('pick-up-plan-system');
Route::GET('/dashboard/changePickUp', [AdminController::class, 'changePickUp'])
    ->middleware(['auth'])->name('changePickUp');
Route::GET('/dashboard/ConfirmPickUpChange', [AdminController::class, 'ConfirmPickUpChange'])
    ->middleware(['auth'])->name('ConfirmPickUpChange');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
