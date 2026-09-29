<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\CompensationRuleController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CompensationController;
use App\Http\Controllers\NotificationController;


// USERS
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


// CATEGORIES
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);


// LOCATIONS
Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/{id}', [LocationController::class, 'show']);
Route::put('/locations/{id}', [LocationController::class, 'update']);
Route::delete('/locations/{id}', [LocationController::class, 'destroy']);


// LOST ITEMS
Route::get('/lost-items', [LostItemController::class, 'index']);
Route::post('/lost-items', [LostItemController::class, 'store']);
Route::get('/lost-items/{id}', [LostItemController::class, 'show']);
Route::put('/lost-items/{id}', [LostItemController::class, 'update']);
Route::delete('/lost-items/{id}', [LostItemController::class, 'destroy']);


// FOUND ITEMS
Route::get('/found-items', [FoundItemController::class, 'index']);
Route::post('/found-items', [FoundItemController::class, 'store']);
Route::get('/found-items/{id}', [FoundItemController::class, 'show']);
Route::put('/found-items/{id}', [FoundItemController::class, 'update']);
Route::delete('/found-items/{id}', [FoundItemController::class, 'destroy']);


// COMPENSATION RULES
Route::get('/compensation-rules', [CompensationRuleController::class, 'index']);
Route::post('/compensation-rules', [CompensationRuleController::class, 'store']);
Route::get('/compensation-rules/{id}', [CompensationRuleController::class, 'show']);
Route::put('/compensation-rules/{id}', [CompensationRuleController::class, 'update']);
Route::delete('/compensation-rules/{id}', [CompensationRuleController::class, 'destroy']);


// CLAIMS
Route::get('/claims', [ClaimController::class, 'index']);
Route::post('/claims', [ClaimController::class, 'store']);
Route::get('/claims/{id}', [ClaimController::class, 'show']);
Route::put('/claims/{id}', [ClaimController::class, 'update']);
Route::delete('/claims/{id}', [ClaimController::class, 'destroy']);


// COMPENSATIONS
Route::get('/compensations', [CompensationController::class, 'index']);
Route::post('/compensations', [CompensationController::class, 'store']);
Route::get('/compensations/{id}', [CompensationController::class, 'show']);
Route::put('/compensations/{id}', [CompensationController::class, 'update']);
Route::delete('/compensations/{id}', [CompensationController::class, 'destroy']);


// NOTIFICATIONS
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::get('/notifications/{id}', [NotificationController::class, 'show']);
Route::put('/notifications/{id}', [NotificationController::class, 'update']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);