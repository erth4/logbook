<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update_profile'])->name('profile');
    
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook');
    Route::post('/logbook/json', [LogbookController::class, 'json_data'])->name('logbook.json');
    Route::get('/logbook/tambah', [LogbookController::class, 'create'])->name('logbook.create');
    Route::post('/logbook/simpan', [LogbookController::class, 'store'])->name('logbook.store');
    Route::get('/logbook/edit/{id}', [LogbookController::class, 'edit'])->name('logbook.edit');
    Route::post('/logbook/update', [LogbookController::class, 'update'])->name('logbook.update');
    Route::get('/logbook/export/{any}', [LogbookController::class, 'export'])->name('logbook.export');
    Route::post('/logbook/delete', [LogbookController::class, 'destroy'])->name('logbook.destroy');

    Route::group(['middleware' => 'guards'], function() {

        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::post('/users/list', [UsersController::class, 'list'])->name('users.list');
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/users/update', [UsersController::class, 'update'])->name('users.update');
        Route::post('/users/delete', [UsersController::class, 'destroy'])->name('users.delete');
        Route::get('/users/activation/{id}', [UsersController::class, 'activation'])->name('users.activation');

    });
});

Route::get('/terms', [PageController::class, 'terms'])->name('terms');

