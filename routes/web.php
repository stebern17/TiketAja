<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\CatalogueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', [CatalogueController::class, 'index'])->name('catalogue.index');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Rute untuk Event
Route::resource('events', EventController::class);
Route::get('/catalogue/{id_event}', [CatalogueController::class, 'showEvent'])->name('user.catalogue.showEvent');

// Rute untuk Tickets
Route::get('/tickets/create/{event_id}', [TicketsController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
Route::get('/events/{event}/tickets', [TicketsController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
Route::put('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');

// Rute untuk Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
