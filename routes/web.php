<?php

use App\Http\Controllers\AuthController;
use App\Livewire\AkunLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\OperasionalLivewire;
use App\Livewire\UserLivewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', DashboardLivewire::class)->name('dashboard');
    Route::get('/user', UserLivewire::class)->name('user');
    Route::get('/operasional', OperasionalLivewire::class)->name('operasional');
    Route::get('/akun', AkunLivewire::class)->name('akun')->middleware('admin');
});
