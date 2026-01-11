@extends('admin.layouts.app')

@section('title', 'Редактирование статьи')

@section('content')
<form method="POST" action="{{ route('admin.articles.update', $article) }}" class="space-y-6 max-w-4xl">

    @csrf
    @method('PUT')

    {{-- Заголовок --}}
    <div>
        <label class="block mb-1 text-sm">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $article->title) }}"
            class="w-full bg-slate-800 border border-slate-700 rounded p-2" required>
    </div>

    {{-- Slug --}}
    <div>
        <label class="block mb-1 text-sm">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
            class="w-full bg-slate-800 border border-slate-700 rounded p-2">
    </div>

    {{-- Категория --}}
    <div>
        <label class="block mb-1 text-sm">Категория</label>
        <select name="categories[]" multiple class="form-select w-full bg-slate-800 border border-slate-700 rounded p-2">
            <option value="">— Без категории —</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    {{-- Краткое описание --}}
    <div>
        <label class="block mb-1 text-sm">Краткое описание</label>
        <textarea name="excerpt" rows="3"
            class="w-full bg-slate-800 border border-slate-700 rounded p-2">{{ old('excerpt', $article->excerpt) }}</textarea>
    </div>

    {{-- Markdown --}}
    <div>
        <label class="block mb-2 text-sm font-semibold">
            Контент статьи (Markdown)
        </label>

        <textarea id="markdown-editor" name="content_md"
            class="hidden">{{ old('content_md', $article->content_md) }}</textarea>
    </div>

    {{-- Статус --}}
    <div>
        <label class="block mb-1 text-sm">Статус</label>
        
        <select name="status" class="w-full bg-slate-800 border border-slate-700 rounded p-2">
            <option value="draft" @selected(old('status', $article->status ?? 'draft') === 'draft')>
                Черновик
            </option>
            <option value="published" @selected(old('status', $article->status ?? '') === 'published')>
                Опубликована
            </option>
            <option value="archived" @selected(old('status', $article->status ?? '') === 'archived')>
                Архив
            </option>
        </select>
    </div>

    {{-- Кнопки --}}
    <div class="flex gap-4">
        <button class="bg-emerald-600 hover:bg-emerald-500 px-6 py-2 rounded">
            Сохранить
        </button>

        <a href="{{ route('admin.articles.index') }}"
            class="px-6 py-2 rounded border border-slate-600 hover:bg-slate-800">
            Отмена
        </a>
    </div>

</form>
@endsection