<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_articles(): void
    {
        $this->withoutExceptionHandling();
        
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo articulo', 
                    'slug' => 'nuevo-articulo', 
                    'content' => 'Contenido del articulo', 
                ]
            ]
        ]);
        $response->assertCreated();

        $article = Article::first();

        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article)
        );

        $response->assertExactJson([
            'data' => [
                'type' => 'article',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo articulo', 
                    'slug' => 'nuevo-articulo', 
                    'content' => 'Contenido del articulo', 
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]            
        ]);
    }
    /** @test */
    public function title_is_required()
    {
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del artículo'
                ]
            ]
        ])->dump();
        $response->assertJsonValidationErrors('data.attributes.title');
    }
    /** @test */
    public function title_must_be_at_least_4_characters()
    {
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nue',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del artículo'
                ]
            ]
        ]);
        $response->assertJsonValidationErrors('data.attributes.title');
    }
    /** @test */
    public function slug_is_required()
    {
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo Articulo',
                    'content' => 'Contenido del artículo'
                ]
            ]
        ]);
        $response->assertJsonValidationErrors('data.attributes.slug');
    }
    /** @test */
    public function content_is_required()
    {
        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo Articulo',
                    'slug' => 'nuevo-articulo'
                ]
            ]
        ]);
        $response->assertJsonValidationErrors('data.attributes.content');
    }
}
