@extends('layouts.app')

@section('content')
@foreach($articles as $article)
<div class="article-card">
    @foreach($article->categories as $category)
    <span class="tag">{{ $category->name }}</span>
    @endforeach

    <h3>
        <a href="{{ route('articles.show', $article->slug) }}">
            {{ $article->title }}
        </a>
    </h3>

    <p>{{ Str::limit(strip_tags($article->content), 160) }}</p>
</div>
@endforeach
@endsection