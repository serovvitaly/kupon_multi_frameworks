<div>
    <a href="{{ $doc->getUrl() }}&from=index">
        <h3 class="media-heading title">{{ $doc->title }}</h3>
    </a>
    <p class="" style="display: block;">
        {!! $doc->getAnnotation() !!}
    </p>
    <p class="small">
        <span>{{ $doc->publishedAtFormated('d.m.Y') }}</span>
        &#8226;
        <noindex>
            <span>Источник:
                <a rel="nofollow" target="_blanck" href="{{ $doc->getSourceUrl() }}">{{ $doc->getSourceUrl() }}</a>
            </span>
        </noindex>
    </p>
</div>
<hr>
