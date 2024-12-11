<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('clients',[ClientsController::class,'index'])->name('client.index');
    Route::get('clients/create',[ClientsController::class,'create'])->name('client.create');
    Route::post('clients',[ClientsController::class,'store'])->name('client.store');
    Route::get('clients/{client}/edit', [ClientsController::class, 'edit'])->name('client.edit');
    Route::post('clients/{client}', [ClientsController::class, 'update'])->name('client.update');
    Route::delete('clients/{client}', [ClientsController::class, 'destroy'])->name('client.destroy');
});

require __DIR__.'/auth.php';
