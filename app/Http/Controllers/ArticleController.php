<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    // список статей
    public function index(Request $request)
{
    $query = Article::query()
        ->where('status', 'published')
        ->with('categories')
        ->latest();

    if ($request->filled('category')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    return view('articles.index', [
        'articles' => $query->paginate(10)->withQueryString(),
    ]);
}


    // просмотр одной статьи
    public function show(string $slug)
    {
        $article = Article::published()
        ->where('slug', $slug)
        ->with('categories')
        ->firstOrFail();


        // увеличиваем просмотры
        $article->increment('views');

        return view('articles.show', compact('article'));
    }
}


