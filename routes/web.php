<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;

Route::get('/', [ClientController::class, 'index'])->name('dashboard');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::get('/clients/export', [ClientController::class, 'exportCsv'])->name('clients.export');
Route::get('/clients/export-pdf', [ClientController::class, 'exportPdf'])->name('clients.export.pdf');
