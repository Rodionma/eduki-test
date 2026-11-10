<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/health/{id}', [HealthController::class, 'index']);

Route::post('/generate', [VoucherController::class, 'generate']);

Route::post('/apply', [ItemController::class, 'apply']);
