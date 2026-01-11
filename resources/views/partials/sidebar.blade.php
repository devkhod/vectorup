<aside class="sidebar">
    <div class="widget">
    <h3 class="sidebar-title">Категории</h3>

    <ul class="sidebar-categories" style="list-style: none; padding-left: 0px;">
        <li>
            <a href="{{ route('articles.index') }}" class="{{ request()->missing('category') ? 'active' : '' }}">
                Все статьи
            </a>
        </li>

        @foreach($sidebarCategories as $category)
        <li>
            <a href="{{ route('articles.index', ['category' => $category->slug]) }}"
                class="{{ request('category') === $category->slug ? 'active' : '' }}">
                {{ $category->name }}
                <span class="count">{{ $category->articles_count }}</span>
            </a>
        </li>
        @endforeach
    </ul>
    </div>
</aside>