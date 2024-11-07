<?php

namespace App\Http\Controllers\Api;
use App\Models\Article; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return $article;
    }
}
