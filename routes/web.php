<?php

use App\Http\Controllers\Chinook\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Chinook\EmployeesController;
use App\Http\Controllers\Chinook\CustomersController;
use App\Http\Controllers\Chinook\InvoicesController;
use App\Http\Controllers\Chinook\ArtistsController;
use App\Http\Controllers\Chinook\AlbumsController;
use App\Http\Controllers\Chinook\PlaylistsController;
use App\Http\Controllers\Chinook\TracksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->prefix('chinook')->name('chinook.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('employees', [EmployeesController::class, 'index'])->name('employees.index');
    Route::get('employees/index2', [EmployeesController::class, 'index2'])->name('employees.index2');
    

    Route::get('employees/{employee}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
    Route::get('employees/create', [EmployeesController::class, 'create'])->name('employees.create');
    Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');

    Route::get('customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');

    Route::get('invoices', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoicesController::class, 'store'])->name('invoices.store');
    Route::get('invoices/{invoice}', [InvoicesController::class, 'show'])->name('invoices.show');

    Route::get('artists', [ArtistsController::class, 'index'])->name('artists.index');
    Route::get('artists/create', [ArtistsController::class, 'create'])->name('artists.create');
    Route::post('artists', [ArtistsController::class, 'store'])->name('artists.store');
    Route::get('artists/{artist}/edit', [ArtistsController::class, 'edit'])->name('artists.edit');
    Route::put('artists/{artist}', [ArtistsController::class, 'update'])->name('artists.update');
    
    Route::get('albums', [AlbumsController::class, 'index'])->name('albums.index');
    Route::get('albums/create', [AlbumsController::class, 'create'])->name('albums.create');
    Route::post('albums', [AlbumsController::class, 'store'])->name('albums.store');
    Route::get('albums/{album}/edit', [AlbumsController::class, 'edit'])->name('albums.edit');
    Route::put('albums/{album}', [AlbumsController::class, 'update'])->name('albums.update');

    Route::get('playlists', [PlaylistsController::class, 'index'])->name('playlists.index');
    Route::get('playlists/index2', [PlaylistsController::class, 'index2'])->name('playlists.index2');
    
    Route::get('playlists/{playlist}/edit', [PlaylistsController::class, 'edit'])->name('playlists.edit');
    Route::put('playlists/{playlist}', [PlaylistsController::class, 'update'])->name('playlists.update');

    Route::get('tracks/list1', [TracksController::class, 'list1'])->name('tracks.list1');
    Route::get('tracks/list2', [TracksController::class, 'list2'])->name('tracks.list2');

});

Route::middleware('auth')->prefix('ajax')->group(function () {
    Route::get('tracks', [TracksController::class, 'search'])->name('ajax.tracks.search');
});

require __DIR__.'/auth.php';
