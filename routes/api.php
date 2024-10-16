<?php
use App\Http\Controllers\MedicineController;

Route::middleware('auth:sanctum')->post('/add-medicine', [MedicineController::class, 'store']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);