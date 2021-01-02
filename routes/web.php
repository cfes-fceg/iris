<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SessionStreamsController;
use App\Models\SessionStream;
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

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(["prefix" => "admin", "middleware" => ["auth"], "as" => "admin."], function () {
    Route::get("/", [AdminController::class, 'index'])->name('index');

    Route::resource("sessions", SessionsController::class);
    Route::resource("streams", SessionStreamsController::class);
});

require __DIR__ . '/auth.php';
