<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CertificateController::class, 'index'])->name('home');
Route::post('/preview', [CertificateController::class, 'preview'])->name('certificate.preview');
Route::post('/download', [CertificateController::class, 'download'])->name('certificate.download');