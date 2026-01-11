@extends('layouts.app')

@section('title', 'VectorUp — финансы, Forex и инвестиции. Информационный портал')

@section('content')

@foreach($articles as $article)
<article class="article-preview">

    <span class="tag">
        {{ $article->category?->name ?? 'Общее' }}
    </span>

    <h2 class="article-title">
        <a href="{{ route('articles.show', $article->slug) }}">
            {{ $article->title }}
        </a>
    </h2>

    <p class="article-excerpt">
        {{ $article->excerpt }}
    </p>

    <div class="article-meta">
        {{ $article->created_at->format('d.m.Y') }}
    </div>

</article>
@endforeach

@endsection