<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Services\MarkdownService;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
     public function index(Request $request)
{
    $query = Article::query()
        ->with('categories')
        ->latest();

    // Фильтр по статусу
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Фильтр по категории (pivot)
    if ($request->filled('category_id')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('categories.id', $request->category_id);
        });
    }

    return view('admin.articles.index', [
        'articles' => $query->get(),
        'categories' => Category::all(),
        'filters' => $request->only(['status', 'category_id']),
    ]);
}


    public function create()
    {
        return view('admin.articles.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'excerpt' => 'nullable|string',
        'content_md' => 'required|string',
        'status' => 'required|in:draft,published',
        'categories' => 'array',
        'categories.*' => 'exists:categories,id',
    ]);

    $article = Article::create([
        'title' => $data['title'],
        'slug' => $data['slug'] ?? Str::slug($data['title']),
        'excerpt' => $data['excerpt'] ?? null,
        'content' => $data['content_md'],
        'status' => $data['status'],
    ]);

   
    if (!empty($data['categories'])) {
        $article->categories()->sync($data['categories']);
    }

    return redirect()
        ->route('admin.articles.index')
        ->with('success', 'Статья создана');
}


    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }

    public function update(
        Request $request,
        Article $article,
        MarkdownService $markdown
    ) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'excerpt' => 'nullable|string',
            'content_md' => 'required|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $slug = $data['slug'] ?: Str::slug($data['title']);
        

        $article->update([
            'title' => $data['title'],
            'slug' => $slug,
            'excerpt' => $data['excerpt'] ?? null,
            'content_md' => $data['content_md'],
            'content_html' => $markdown->toHtml($data['content_md']),
            'status' => $data['status'],
        ]);

        if (!empty($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }


        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back();
    }
}
