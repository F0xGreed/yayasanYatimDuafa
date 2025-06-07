<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;




// Midtrans webhook (no CSRF protection applied automatically)
Route::post('/midtrans/notification', [PaymentController::class, 'handleNotification']);
