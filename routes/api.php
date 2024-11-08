<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('v1/articles', [ArticleController::class, 'index'])
->name('api.v1.articles.index');

Route::get('v1/articles/{article}', [ArticleController::class, 'show'])
->name('api.v1.articles.show');

Route::post('v1/articles', [ArticleController::class, 'create'])
->name('api.v1.articles.create');
