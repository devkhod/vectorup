<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="UTF-8">
        <title>Admin — VectorUp</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-slate-900 text-slate-100">

        <div class="flex min-h-screen">
            <aside class="w-64 bg-slate-800 p-6">
                <h2 class="text-xl font-bold mb-6">VectorUp</h2>

                <nav class="space-y-2">
                    <a href="{{ route('admin.articles.index') }}" class="block hover:underline">
                        Статьи
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="block hover:underline">
                        Категории
                    </a>
                    @if( Auth::check() && Auth::user()->is_admin )
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-400 hover:underline mt-6">
                            Выйти
                        </button>
                    </form>
                    @endif
                </nav>
            </aside>

            <main class="flex-1 p-8">
                @yield('content')
            </main>
        </div>

    </body>

</html>