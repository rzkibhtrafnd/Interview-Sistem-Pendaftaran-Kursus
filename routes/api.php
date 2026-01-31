<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Route ini TIDAK pakai CSRF dan memang khusus API / Webhook
|--------------------------------------------------------------------------
*/

Route::post('/payments/midtrans/webhook', [PaymentWebhookController::class, 'handle'])
    ->name('api.payments.midtrans.webhook');
