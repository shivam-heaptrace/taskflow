<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/files');

Route::middleware('auth')->group(function () {
    Route::get('/files', [
        FileUploadController::class,
        'index'
    ])->name('files.index');

    Route::post('/files', [
        FileUploadController::class,
        'store'
    ])->name('files.store');

    Route::get('/files/{file}/download', [
        FileUploadController::class,
        'download'
    ])->name('files.download');
});

require __DIR__.'/auth.php';
