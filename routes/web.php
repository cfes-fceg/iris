<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SessionStreamsController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserDashboardController;
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

Route::group(["middleware" => ["auth"]], function () {
    Route::get('/sessions', [UserDashboardController::class, 'index'])->name('sessions');
    Route::get('/discord', [UserDashboardController::class, 'discord'])->name('discord');
    Route::get("/sessions/{session}/join", [SessionsController::class, 'join'])->name("sessions.join");
});

Route::get("/discord/invite", function () {
    return response()->redirectTo("https://discord.gg/BxEpwCT6FW");
})->name('discord.invite');

Route::group(["prefix" => "admin", "middleware" => ["auth", 'admin'], "as" => "admin."], function () {
    Route::get("/", [AdminController::class, 'index'])->name('index');

    Route::resource("sessions", SessionsController::class)->except('show');
    Route::resource("streams", SessionStreamsController::class)->except('show');
    Route::resource("users", UserAdminController::class)->except('show');
});

require __DIR__ . '/auth.php';
