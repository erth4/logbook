<?php

use App\Http\Controllers\API\LogbookController;
use Illuminate\Support\Facades\Route;

Route::resource('logbook', LogbookController::class);

Route::prefix('xml')->group(function() {
    Route::get('logbook', [LogbookController::class, 'xml'])->name('logbook');
});