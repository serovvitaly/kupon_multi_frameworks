<div>
    <a href="{{ $doc->getUrl() }}&from=index">
        <h3 class="media-heading title">{{ $doc->title }}</h3>
    </a>
    <p class="" style="display: block;">
        {!! $doc->getAnnotation() !!}
    </p>
    <p class="small">
        <span>{{ $doc->publishedAtFormated('d.m.Y') }}</span>
    </p>
</div>
<hr>
