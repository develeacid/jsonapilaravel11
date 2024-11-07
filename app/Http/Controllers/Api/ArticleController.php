<?php

namespace App\Http\Controllers\Api;
use App\Models\Article; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return response()->json([
            'data' => [
                'type' =>  'article', 
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug'=> $article->slug, 
                    'content' => $article->content
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
    }
}
