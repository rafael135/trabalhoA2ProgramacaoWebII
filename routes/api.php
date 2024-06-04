<?php

use App\Http\Controllers\LancheController;
use App\Http\Controllers\VendaController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/lanche/{id}", [LancheController::class, "getLanche"])->withoutMiddleware([VerifyCsrfToken::class])->name("api.getLanche");
Route::put("/lanche/{id}", [LancheController::class,"updateLanche"])->withoutMiddleware([VerifyCsrfToken::class])->name("api.putLanche");
Route::delete("/lanche/{id}", [LancheController::class, "deleteLanche"])->withoutMiddleware([VerifyCsrfToken::class])->name("api.deleteLanche");

Route::post("/venda", [VendaController::class, "createVenda"])->withoutMiddleware([VerifyCsrfToken::class])->name("api.createVenda");