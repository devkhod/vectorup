@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Создать категорию</h1>

<form method="POST" action="{{ route('admin.categories.store') }}" class="max-w-xl space-y-6">
    @csrf

    <div>
        <label class="block mb-1 text-sm text-slate-300">Название</label>
        <input type="text" name="name" value="{{ old('name') }}" required
            class="w-full bg-slate-800 border border-slate-700 rounded p-2 focus:outline-none focus:ring focus:ring-emerald-600">
    </div>

    <div>
        <label class="block mb-1 text-sm text-slate-300">Slug</label>
        <input type="text" name="slug" value="{{ old('slug') }}" required
            class="w-full bg-slate-800 border border-slate-700 rounded p-2 focus:outline-none focus:ring focus:ring-emerald-600">
    </div>

    <div>
        <label class="block mb-1 text-sm text-slate-300">Описание</label>
        <textarea name="description" rows="4"
            class="w-full bg-slate-800 border border-slate-700 rounded p-2 focus:outline-none focus:ring focus:ring-emerald-600">{{ old('description') }}</textarea>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded">
            Сохранить
        </button>

        <a href="{{ route('admin.categories.index') }}"
            class="px-4 py-2 rounded border border-slate-600 hover:bg-slate-700">
            Отмена
        </a>
    </div>
</form>
@endsection