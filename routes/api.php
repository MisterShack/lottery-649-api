<?php

use App\Http\Controllers\LotteryTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/ticket/check', [LotteryTicketController::class, 'checkTicket']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
