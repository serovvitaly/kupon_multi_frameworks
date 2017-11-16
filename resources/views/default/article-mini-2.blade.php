<div>
    <a href="{{ $doc->getUrl() }}&from=index">
        <h3 class="media-heading title">{{ $doc->title }}</h3>
    </a>
    <p class="" style="display: block;">
        {!! $doc->getAnnotation() !!}
    </p>
    <noindex>
        <span class="small">Источник:
            <a rel="nofollow" target="_blanck" href="{{ $doc->source_url }}">{{ $doc->source_url }}</a>
        </span>
    </noindex>
</div>
<hr>
