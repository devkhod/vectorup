<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        view()->composer('partials.sidebar', function ($view) {
            $categories = Category::withCount([
                'articles as articles_count' => function ($q) {
                    $q->where('status', 'published');
                }
            ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->get();

            $view->with('sidebarCategories', $categories);
        });
    }
}

