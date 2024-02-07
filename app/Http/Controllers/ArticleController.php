<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $articles= Article::all();
        return view('articles.index', [
            // 'articles' => Article::with('user', 'tags')->latest()->get(),
            'articles' => $articles,
            // 'articles' => Article::with('user', 'tag', 'category')->latest()->get(),

        ]);
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
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'imageUrl' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        $request->user()->articles()->create($validated);

        $article = Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'text' => $request->input('text'),
            'imageUrl' => $request->input('imageUrl'),
        ]);

        $selectedTags = $request->input('tags', []);
        $selectedCategories = $request->input('categories', []);

        // Associer les tags sélectionnés à l'article
        $article->tags()->sync($selectedTags);

        // Associer les catégories sélectionnées à l'article
        $article->categories()->sync($selectedCategories);

        return redirect(route('articles.index'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
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
