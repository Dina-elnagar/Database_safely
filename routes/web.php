<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

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
Route::get('',[WebsiteController::class,'Home'])->name('Home');
Route::post('Order',[WebsiteController::class,'postOrder'])->name('postOrder');
Route::get('aboutus', function () {
    return view('aboutus');
});
Route::get('blog', function () {
    return view('blog');
});
Route::get('blog1', function () {
    return view('blog1');
});
Route::get('blog2', function () {
    return view('blog2');
});
Route::get('blog3', function () {
    return view('blog3');
});
Route::get('Arduino', function () {
    return view('Arduino');
});
Route::get('How_it_works', function () {
    return view('How_it_works');
});

/*
Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
/** */
