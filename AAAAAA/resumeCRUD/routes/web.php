<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::delete('/index/delete/{resume}', [IndexController::class, 'destroy'])->name('resume.delete');
Route::get('/show/{resume}', [IndexController::class, 'show'])->name('resume.show');

Route::get('index/{resume}/edit', [IndexController::class, 'edit'])->name('resume.edit');
Route::put('index/update/{resume}', [IndexController::class, 'update'])->name('resume.update');

Route::get('/form', [IndexController::class, 'create'])->name('resume.create');
Route::post('/add', [IndexController::class, 'store'])->name('resume.store');

Route::get('/q1', [IndexController::class, 'getSurnamesWithStage'])->name('resume.getSurname');
Route::get('/q2', [IndexController::class, 'getProgers'])->name('resume.getProgers');
Route::get('/q3', [IndexController::class, 'countResumes'])->name('resume.count');
Route::get('/q4', [IndexController::class, 'getPresentedStaff'])->name('resume.getPresentedStaff');
