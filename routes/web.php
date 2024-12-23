<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Exports\OrdersExport;
use App\Exports\EventsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Admin\TicketValidationController;
// user
use App\Http\Controllers\User\CatalogueController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\OrderDetailController;
use App\Http\Controllers\User\UserController as UserSettingsController;

// -------------------Main--------------------------
Route::get('/', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::get('/catalogue/event', [CatalogueController::class, 'showEvent'])->name('catalogue.event');
Route::get('/catalogue', [CatalogueController::class, 'showAllEvents'])->name('user.catalogue.showAllEvents');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// -------------------Admin--------------------------

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Rute untuk User Management
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
});


// Rute untuk Event\
Route::prefix('admin')->group(function () {
    Route::resource('events', EventController::class);
});

// Rute untuk Tickets Admin
Route::prefix('admin')->group(function () {
    Route::get('/tickets/create/{event_id}', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/events/{event}/tickets', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');
});


// Rute untuk Admin Order
Route::prefix('admin')->group(function () {
    Route::get('Admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('orders/{order}/payment-proof', [AdminOrderController::class, 'showPaymentProof'])->name('admin.orders.showPaymentProof');
    Route::post('orders/{order}/send-receipt', [AdminOrderController::class, 'sendReceipt'])->name('admin.orders.sendReceipt');
});


// Rute untuk Export Excel
Route::prefix('admin')->group(function () {
    Route::get('/admin/orders/export', function () {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    })->name('admin.orders.export');

    Route::get('/admin/events/export', function () {
        return Excel::download(new EventsExport, 'events.xlsx');
    })->name('admin.events.export');

    Route::get('/admin/export-sales-report', [AdminController::class, 'exportSalesReport'])->name('admin.exportSalesReport');
});


// Rute untuk Sales Graph

Route::prefix('admin')->group(function () {
    Route::get('/ticket-validation', [TicketValidationController::class, 'showTicketValidationPage'])->name('admin.ticketValidation');
    Route::post('/admin/ticketValidation/validate', [TicketValidationController::class, 'validateTicket'])->name('admin.ticketValidation.validate');
    Route::post('/admin/ticketValidation/fetchTicketData', [TicketValidationController::class, 'fetchTicketData'])->name('admin.ticketValidation.fetchTicketData');
});

// --------------------User-------------------------
// Rute untuk User
Route::middleware('auth')->group(function () {
    // Katalog
    Route::get('/catalogue/{id_event}', [CatalogueController::class, 'showEvent'])->name('user.catalogue.showEvent');

    //setting
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // tiket
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::get('/ticket/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::put('/ticket/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy');

    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::get('/order/{id_order}', [OrderController::class, 'ShowEventOrder'])->name('order.ShowEventOrder');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    // routes/web.php
    Route::get('orders', [OrderController::class, 'index'])->name('user.orders.index');
    Route::get('orderDetail/{id_order_detail}', [OrderDetailController::class, 'show'])->name('user.orderDetail.show');

    // Setting
    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/settings', [UserSettingsController::class, 'settings'])->name('user.settings');
        Route::post('/settings', [UserSettingsController::class, 'updateSettings'])->name('user.settings.update');
    });
});
