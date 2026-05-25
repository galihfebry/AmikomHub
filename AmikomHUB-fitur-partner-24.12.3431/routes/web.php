<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [TicketController::class, 'ticket'])->name('ticket');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [DashboardController::class, 'indexAdmin'])->name('events.index');
    Route::get('/transactions', [DashboardController::class, 'transactionsAdmin'])->name('transactions.index');
});


Route::get('/profil', function() {
    return view('profil');
});

Route::get('/katalog', function() {
    return view('katalog');
});

Route::get('/bantuan', function() {
    return view('bantuan');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventAdminController::class);
});


Route::get('/admin/partners', [PartnerController::class, 'index']);
Route::get('/admin/partners/create', [PartnerController::class, 'create']);
Route::post('/admin/partners/store', [PartnerController::class, 'store']);

Route::prefix('admin')->group(function () {

    Route::get('/partners', [PartnerController::class, 'index'])
    ->name('admin.partners.index');

    Route::get('/partners/create', [PartnerController::class, 'create']);

    Route::post('/partners/store', [PartnerController::class, 'store'])
        ->name('partners.store');

    Route::get('/partners/edit/{id}', [PartnerController::class, 'edit']);

    Route::put('/partners/update/{id}', [PartnerController::class, 'update'])
        ->name('partners.update');

    Route::delete('/partners/delete/{id}', [PartnerController::class, 'destroy'])
        ->name('partners.destroy');

});

        

Route::prefix('admin')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::post('/categories/store', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

});



