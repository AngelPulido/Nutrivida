<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureApiToken;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;


// RUTAS PÚBLICAS
Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login',   [AuthController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register',[RegisterController::class, 'register'])->name('register');

// =========================
// RUTAS PROTEGIDAS
// =========================

// ADMINISTRADOR
Route::prefix('/dashboard/Administrador')
     ->middleware(EnsureApiToken::class)
     ->group(function () {
         // Al entrar al Dashboard, redirigimos a /profile
         Route::get('/', function () {
             return redirect()->route('dashboard.admin.profile');
         })->name('dashboard.admin.home');

         Route::get('/profile', [ProfileController::class, 'show'])
              ->defaults('role', 'admin')
              ->name('dashboard.admin.profile');

         Route::put('/profile', [ProfileController::class, 'update'])
              ->defaults('role', 'admin')
              ->name('dashboard.admin.profile.update');

         Route::get('/miperfil', [ProfileController::class, 'myProfile'])
              ->defaults('role', 'admin')
              ->name('dashboard.admin.miperfil');
});

// NUTRIÓLOGO
Route::prefix('/dashboard/nutriologo')
     ->middleware(EnsureApiToken::class)
     ->group(function () {
         // Al entrar al Dashboard, redirigimos a /profile
         Route::get('/', function () {
             return redirect()->route('dashboard.nutriologo.profile');
         })->name('dashboard.nutriologo.home');

         Route::get('/profile', [ProfileController::class, 'show'])
              ->defaults('role', 'nutriologo')
              ->name('dashboard.nutriologo.profile');

         Route::put('/profile', [ProfileController::class, 'update'])
              ->defaults('role', 'nutriologo')
              ->name('dashboard.nutriologo.profile.update');

         Route::get('/miperfil', [ProfileController::class, 'myProfile'])
              ->defaults('role', 'nutriologo')
              ->name('dashboard.nutriologo.miperfil');
});

Route::prefix('/dashboard/paciente')
     ->middleware(EnsureApiToken::class)
     ->group(function () {
         // Al entrar al Dashboard, redirigimos a /profile
         Route::get('/', function () {
             return redirect()->route('dashboard.paciente.profile');
         })->name('dashboard.paciente.home');

         Route::get('/profile', [ProfileController::class, 'show'])
              ->defaults('role', 'paciente')
              ->name('dashboard.paciente.profile');

         Route::put('/profile', [ProfileController::class, 'update'])
              ->defaults('role', 'paciente')
              ->name('dashboard.paciente.profile.update');

         Route::get('/miperfil', [ProfileController::class, 'myProfile'])
              ->defaults('role', 'paciente')
              ->name('dashboard.paciente.miperfil');
});

Route::prefix('/dashboard/Administrador')              // cambia 'administrador' a 'admin'
     ->middleware(EnsureApiToken::class)
     ->group(function () {
         // Home del dashboard (redirige al listado de usuarios)
         Route::get('/', fn() => redirect()->route('dashboard.admin.users.index'))
              ->name('dashboard.admin.home');  // antes dashboard.administrador.home

         // CRUD de usuarios
         Route::resource('users', AdminUserController::class, [
             'as' => 'dashboard.admin'        // antes 'dashboard.administrador'
         ]);
     });


