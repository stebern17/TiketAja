<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
// user
use App\Http\Controllers\User\CatalogueController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::get('/catalogue/event', [CatalogueController::class, 'showEvent'])->name('catalogue.event');
Route::get('/catalogue', [CatalogueController::class, 'showAllEvents'])->name('user.catalogue.showAllEvents');



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

// Rute untuk Tickets Admin
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
// Rute untuk Admin Order
Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('orders/{order}/payment-proof', [AdminOrderController::class, 'showPaymentProof'])->name('admin.orders.showPaymentProof');



// Rute untuk User
Route::middleware('auth')->group(function () {
    // Katalog
    Route::get('/catalogue/{id_event}', [CatalogueController::class, 'showEvent'])->name('user.catalogue.showEvent');

    // tiket 
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::get('/ticket/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::put('/ticket/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy');
});
