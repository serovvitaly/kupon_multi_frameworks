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
    <p class="small">
        <span>{{ $published_at }}</span>
        &#8226;
        <noindex>
            <span>Источник:
                <a rel="nofollow" target="_blanck" href="{{ $source_url }}">{{ $source_url }}</a>
            </span>
        </noindex>
    </p>
    <hr>
    <article class="post-content">
        {!! $content !!}
    </article>
@endsection
