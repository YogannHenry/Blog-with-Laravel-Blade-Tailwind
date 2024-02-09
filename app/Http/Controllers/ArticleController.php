<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $articles = Article::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('articles.index', compact('articles', 'tags', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'text' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'imageUrl' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        // Création de l'article
        $article = $request->user()->articles()->create($validatedData);
        // Attacher les tags à l'article

        // Création ou association des tags
        if ($request->has('tags')) {
        $tagIds = $request->input('tags');

                DB::table('article_tag')->insert(['article_id' => $article->id, 'tag_id' => $tagIds[0]]);
        }

        if ($request->has('categories')) {
            $categoryIds = $request->input('categories');
            DB::table('article_categories')->insert(['article_id' => $article->id, 'category_id' => $categoryIds[0]]);
        }

        return redirect(route('articles.index'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $chirps = Article::get($article->id);
            return view('articles.article', compact('article', 'chirps'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        $this->authorize('update', $article);

        return view('articles.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'imageUrl' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        $article->update($validated);

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect(route('articles.index'));
    }
}
