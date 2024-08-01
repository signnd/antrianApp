<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/queue', [QueueController::class, 'index'])->name('queue.index');
Route::get('/queue/generate', [QueueController::class, 'generate'])->name('queue.generate');

Route::get('/queue/print/{id}', [QueueController::class, 'print'])->name('queue.print');
Route::get('/queue/print-queue', [QueueController::class, 'printQueue'])->name('queue.printqueue');