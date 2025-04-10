<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Rotas para Solicitações
Route::prefix('requests')->group(function () {
    Route::get('create', [RequestController::class, 'create'])->name('requests.create');
    Route::post('/', [RequestController::class, 'store'])->name('requests.store');
    Route::get('{request}', [RequestController::class, 'show'])->name('requests.show');
    Route::get('{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
    Route::post('{request}/update-status', [RequestController::class, 'updateStatus'])->name('requests.update-status');
    Route::delete('{request}', [RequestController::class, 'destroy'])->name('requests.destroy');
});
