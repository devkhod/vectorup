@extends('admin.layouts.app')

@section('title', 'Категории')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold mb-6">Категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded text-sm">
        + Новая категория
    </a>
</div>
@if ($categories->count())
    <div class="space-y-4">
        @foreach($categories as $category)
        <div class="bg-slate-800 rounded p-6 text-slate-300 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">{{ $category->name . " " }}<span>({{ $category->articles_count }})</span></h2>
                <p class="text-sm text-gray-400 mt-1">{{ $category->description }}</p>
            </div>
            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded text-sm">
                Редактировать
            </a>
        </div>
        @endforeach
    </div>

    
@else
<div class="bg-slate-800 rounded p-6 text-slate-300">
    <p>Категорий пока нет.</p>
</div>
@endif
@endsection