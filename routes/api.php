<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;


Route::controller(ArticleController::class)->name('articles.')->group(function () {
    Route::get('/articles', 'index')->name('index');
    Route::post('/import', 'store')->name('store');
});
