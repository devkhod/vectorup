


@extends('layouts.app')

@section('content')
<article class="markdown">
    <h1>{{ $article->title }}</h1>

    <div class="article-meta">
        <span>{{ $article->created_at->format('d.m.Y') }}</span>
    </div>

    {!! $article->content_html !!}
</article>
@endsection