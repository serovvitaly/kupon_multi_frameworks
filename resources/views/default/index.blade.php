@extends('default.layout-12')

@section('title', 'Супер блог 2')

@section('og_meta')
@if(isset($article_id))
<meta property="og:title" content="{{ $title }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ $url }}" />
<meta property="og:image" content="{{ $image }}" />
@endif
@endsection

@section('center')
<div class="row">
    <div class="col-lg-12">
        @foreach($documents as $document)
            @include('default.article-mini-2', ['doc' => $document])
        @endforeach
    </div>
    <div class="col-lg-12">
        <div class="row">
            {{ $documents->links() }}
        </div>
    </div>
</div>
@endsection