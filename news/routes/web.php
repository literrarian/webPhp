<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/show/{artId}', [IndexController::class, 'show'])->name('article.show');
Route::get('/rubrics/show/{id}', [IndexController::class, 'showRubric'])->name('rubric.show');
Route::delete('/articles/delete/{article}', [IndexController::class, 'destroy'])->name('article.destroy');
Route::get('/create/article', [IndexController::class, 'createArticle'])->name('article.create');
Route::post('/add/article', [IndexController::class, 'storeArticle'])->name('article.store');

Route::get('/append/rubric', [IndexController::class, 'createRubric'])->name('rubric.create');
Route::post('/add/rubric', [IndexController::class, 'storeRubric'])->name('rubric.store');

Auth::routes();

Route::get('/home', [IndexController::class, 'index'])->name('home');
