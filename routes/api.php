<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Listar Reports
Route::get('api/v1/reports', [ReportController::class, 'listReports'])->name('reports.list');

// Criar Reports
Route::post('api/v1/reports', [ReportController::class, 'createReport'])->name('reports.create');

// Deletar Reports
Route::delete('api/v1/reports/{id}', [ReportController::class, 'deleteReport'])->name('reports.delete');
