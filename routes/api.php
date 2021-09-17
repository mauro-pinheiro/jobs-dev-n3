<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Listar Reports
Route::get('v1/reports', [ReportController::class, 'listReports'])->name('reports.list');

// Criar Reports
Route::post('v1/reports', [ReportController::class, 'createReport'])->name('reports.create');

// Deletar Reports
Route::delete('v1/reports/{id}', [ReportController::class, 'deleteReport'])->name('reports.delete');
