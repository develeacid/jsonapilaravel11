<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    public function index()
    {
        //$articles = Article::all();

        return ArticleCollection::make(Article::all());
    }
}
