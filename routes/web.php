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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [App\Http\Controllers\systemController::class, 'index'])->name('top');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobofferform', [App\Http\Controllers\SystemController::class, 'jobofferform'])->name('jobofferform');

Route::post('/joboffersend', [App\Http\Controllers\SystemController::class, 'joboffersend'])->name('joboffersend');

Route::post('/jobserach', [App\Http\Controllers\SystemController::class, 'jobserach'])->name('jobserach');

Route::get('/jobpage/{id}', [App\Http\Controllers\SystemController::class, 'jobpage'])->name('jobpage');

Route::get('/myjoboffer', [App\Http\Controllers\SystemController::class, 'myjoboffer'])->name('myjoboffer');

Route::get('/myjobentry', [App\Http\Controllers\SystemController::class, 'myjobentry'])->name('myjobentry');

Route::post('/entrypage/{id}', [App\Http\Controllers\SystemController::class, 'entrypage'])->name('entrypage');

Route::post('/jobentry/{id}', [App\Http\Controllers\SystemController::class, 'jobentry'])->name('jobentry');

Route::get('/profile', [App\Http\Controllers\SystemController::class, 'profile'])->name('profile');

Route::post('/editprofile', [App\Http\Controllers\SystemController::class, 'editprofile'])->name('editprofile');

});