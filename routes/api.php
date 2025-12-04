<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers Imports
use App\Http\Controllers\InvitationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/invite', [InvitationController::class, 'store']);