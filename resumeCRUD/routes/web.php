<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;


Route::get('/', [IndexController::class, 'index']);
Route::get('/show/{id}', [IndexController::class, 'show']);
Route::get('/q1', [IndexController::class, 'getSurnamesWithStage']);
Route::get('/q2', [IndexController::class, 'getProgers']);
Route::get('/q3', [IndexController::class, 'countResumes']);
Route::get('/q4', [IndexController::class, 'getPresentedStaff']);
