<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'author_id' => Auth::id() ?? 1,
        ]);

        return (new ArticleResource($article))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $request->validate([
            'title' => ["sometimes", "max:20", Rule::unique('articles')->ignore($article->title, 'title')],
        ]);

        $article->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'author_id' => Auth::id() ?? 1,
        ]);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json()->setStatusCode(204);
    }
}
