<?php

use App\Http\Controllers\CutterController;
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

Route::get('/', [CutterController::class, 'index'])->name('home');

Route::group(['prefix' => 'cutter', 'as' => 'cutter.'], function () {
    Route::post('', [CutterController::class, 'store'])->name('store');
});

Route::get('/{hash}', [CutterController::class, 'redirect'])->name('hash');