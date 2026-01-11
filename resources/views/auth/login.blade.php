@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-16">
    <h1 class="text-2xl font-bold mb-6 text-center">Вход в админку</h1>

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 text-sm">Email</label>
            <input type="email" name="email" required class="w-full bg-slate-800 border border-slate-700 rounded p-2">
        </div>

        <div>
            <label class="block mb-1 text-sm">Пароль</label>
            <input type="password" name="password" required
                class="w-full bg-slate-800 border border-slate-700 rounded p-2">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember">
            <span class="text-sm">Запомнить меня</span>
        </div>

        @error('email')
        <p class="text-red-400 text-sm">{{ $message }}</p>
        @enderror

        <button class="w-full bg-emerald-600 hover:bg-emerald-500 py-2 rounded">
            Войти
        </button>
    </form>
</div>
@endsection