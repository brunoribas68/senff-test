<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

// Rotas para Solicitações
Route::get('create', [RequestController::class, 'create'])->name('requests.create');
Route::post('/', [RequestController::class, 'store'])->name('requests.store');
Route::get('/', [RequestController::class, 'index'])->name('requests.index');
Route::get('/{id_request}', [RequestController::class, 'show'])->name('requests.show');
Route::get('{id_request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
Route::put('{id_request}/update-status', [RequestController::class, 'updateStatus'])->name('requests.update-status');
Route::post('{id_request}/destroy', [RequestController::class, 'destroy'])->name('requests.destroy');
Route::get('export', [RequestController::class, 'export'])->name('requests.export');
