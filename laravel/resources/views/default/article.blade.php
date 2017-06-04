@extends('default.layout-12')

@section('title', $title)

@section('og_meta')
    @if(isset($article_id))
        <meta property="og:title" content="{{ $title }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ $url }}" />
        <meta property="og:image" content="{{ $image }}" />
    @endif
@endsection

@section('center')
    <h3 class="title">{{ $title }}</h3>
    <article class="post-content">
        {!! $content !!}
    </article>
    <p>
        <a href="{{ $source_url }}" class="btn btn-sm btn-default" target="_blank">
            <strong>Источник:</strong> {{ $source_base_url }}
        </a>
    </p>
@endsection
