<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::post("/login", [App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [App\Http\Controllers\UserController::class, "register"]);
    Route::post("/logout", [App\Http\Controllers\UserController::class, "logout"]);
    Route::get("/csrf", [App\Http\Controllers\UserController::class, "csrf"]);
    Route::post("/game/create", [App\Http\Controllers\GameController::class, "create"]);
    Route::get("/game", [App\Http\Controllers\GameController::class, "index"]);
    Route::get("/game/{id}", [App\Http\Controllers\GameController::class, "show"]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum', 'web');