@extends('admin.layouts.app')

@section('title', 'Статьи')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Статьи</h1>

    <a href="{{ route('admin.articles.create') }}"
        class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded text-sm">
        + Новая статья
    </a>
</div>

{{-- Фильтры --}}
<form method="GET" class="bg-slate-800 rounded p-4 mb-6 flex gap-4 items-end">

    {{-- Статус --}}
    <div>
        <label class="block text-sm mb-1">Статус</label>
        <select name="status" class="bg-slate-900 border border-slate-700 rounded p-2 text-sm">
            <option value="">Все</option>
            <option value="draft" @selected(($filters['status'] ?? '' )==='draft' )>
                Черновик
            </option>
            <option value="published" @selected(($filters['status'] ?? '' )==='published' )>
                Опубликована
            </option>
            <option value="archived" @selected(($filters['status'] ?? '' )==='archived' )>
                Архив
            </option>
        </select>
    </div>

    {{-- Категория --}}
    <div>
        <label class="block text-sm mb-1">Категория</label>
        <select name="category_id" class="bg-slate-900 border border-slate-700 rounded p-2 text-sm">
            <option value="">Все</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '' )==$category->id)>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    {{-- Кнопки --}}
    <div class="flex gap-2">
        <button class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded text-sm">
            Применить
        </button>

        <a href="{{ route('admin.articles.index') }}"
            class="px-4 py-2 rounded border border-slate-600 text-sm hover:bg-slate-700">
            Сбросить
        </a>
    </div>
</form>

{{-- Таблица --}}
<div class="bg-slate-800 rounded">
    <table class="w-full text-sm">
        <thead class="text-left text-slate-400 border-b border-slate-700">
            <tr>
                <th class="p-4">Заголовок</th>
                <th class="p-4">Статус</th>
                <th class="p-4 w-32"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr class="border-b border-slate-700 hover:bg-slate-700/50">
                <td class="p-4">{{ $article->title }}</td>
                <td class="p-4">
                    @if($article->status === 'published')
                    <span class="text-emerald-400">Опубликована</span>
                    @elseif($article->status === 'draft')
                    <span class="text-slate-400">Черновик</span>
                    @else
                    <span class="text-yellow-400">Архив</span>
                    @endif
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-emerald-400 hover:underline">
                        Редактировать
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-6 text-center text-slate-400">
                    Статей не найдено
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection