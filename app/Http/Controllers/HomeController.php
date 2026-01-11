<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $articles = Article::published()
                ->latest()
                ->limit(10)
                ->get();
        return view('pages.home', compact('categories', 'articles'));
        
    }
}
