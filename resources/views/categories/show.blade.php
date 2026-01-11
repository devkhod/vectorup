@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">
        {{ $category->name }}
    </h1>

    @if($category->description)
    <p class="text-gray-400 mb-6">
        {{ $category->description }}
    </p>
    @endif

    <div class="space-y-6">
        @foreach($category->articles as $article)
        <article class="border-b pb-4">
            <h2 class="text-2xl font-semibold">
                <a href="{{ route('articles.show', $article->slug) }}">
                    {{ $article->title }}
                </a>
            </h2>
            <p class="text-gray-400 mt-2">
                {{ $article->excerpt }}
            </p>
        </article>
        @endforeach
    </div>
</div>
@endsection