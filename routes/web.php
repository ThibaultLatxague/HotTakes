<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\Api\SauceApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resources(['sauces' => SauceController::class]);
Route::get('/like/{id}', [SauceController::class, 'like'])->name('like');
Route::get('/dislike/{id}', [SauceController::class, 'dislike'])->name('dislike');
Route::apiResource('api/sauces', SauceApiController::class)->names([
    'index' => 'api.sauces.index',
    'store' => 'api.sauces.store',
    'show' => 'api.sauces.show',
    'update' => 'api.sauces.update',
    'destroy' => 'api.sauces.destroy',
]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
