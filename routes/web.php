<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LancheController;
use App\Http\Controllers\GraficoController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, "index"])->name("homeView");
Route::get("/login", [AuthController::class, "loginView"])->name("loginView");
Route::post("/login", [AuthController::class,"loginAction"])->name("loginAction");
Route::get("/register", [AuthController::class,"registerView"])->name("registerView");
Route::post("/register", [AuthController::class,"registerAction"])->name("registerAction");
Route::get("logout", [AuthController::class, "logoutAction"])->name("logoutAction");

Route::post("/lanche", [LancheController::class, "registerLanche"])->name("registerLancheAction");

Route::get("/graficos", [GraficoController::class, "index"])->name("graficoView");