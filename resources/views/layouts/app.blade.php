{{-- <!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'VectorUp — финансы и трейдинг для новичков')</title>

        <meta name="description"
            content="@yield('meta_description', 'Образовательный проект о финансах, Forex и инвестициях для начинающих.')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-slate-900 text-slate-100">

        @include('partials.header')
        @include('partials.sidebar')
        <main class="max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </main>

        @include('partials.footer')

    </body>

</html> --}}

<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="UTF-8">
        <title>{{ $title ?? 'VectorUp — финансы и инвестиции' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite( ['resources/css/front.css'])
    </head>

    <body>

        <header class="site-header">
            <div class="container header-row">
                <div class="logo">
                    <a href="{{ route('home') }}">VectorUp</a>
                </div>

                <nav>
                    <a href="{{ route('home') }}">Главная</a>
                    <a href="#">Инвестиции</a>
                    <a href="#">Финансы</a>
                    <a href="#">Обучение</a>
                </nav>
            </div>
        </header>

        <div class="container layout">
            <aside>
                @include('partials.sidebar')
            </aside>

            <main>
                @yield('content')
            </main>

            <div class="rightbar">
                @include('partials.rightbar')
            </div>
        </div>

        <footer>
            <div class="container">
                © {{ date('Y') }} VectorUp · Образовательный проект. Не является инвестиционной рекомендацией.
            </div>
        </footer>

    </body>

</html>