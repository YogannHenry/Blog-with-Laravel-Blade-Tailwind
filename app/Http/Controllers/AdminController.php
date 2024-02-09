<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $articles = Article::all();
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();
        $chirps = Chirp::all();
        return view('admin.index', compact('articles', 'tags', 'categories', 'users', 'chirps'));
    }



    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        $this->authorize('update', $chirp);

        dd($request);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'validatedByAdmin' => 'required|boolean',
        ]);

        dd($validated);

        $chirp->update($validated);

        return redirect()->route('admin.index');
    }




}
