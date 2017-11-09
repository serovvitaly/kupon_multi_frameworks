<div id="post-item-{{ $article_id }}" class="row post-mini">
    <div class="col-lg-12">
        <div>
            @if ($ribbon_logo_url)
                <img
                        class="ribbon-icon"
                        alt="64x64"
                        src="{{ $ribbon_logo_url }}"
                >
            @endif
            <strong class="small" style="padding-left: 5px;">{{ $ribbon_title }}</strong>
        </div>
        <h3 class="media-heading title">{{ $article_title }}</h3>
    </div>
    <div>

        @if ($article_image_url)
        <img alt="{{ $article_title }}" src="{{ $article_image_url }}" style="margin-bottom: 10px;">
        @endif
        <div class="small panel-content">{!! $article_annotation !!}</div>
        <a class="btn" href="{{ $article_url }}?from=index">
            <strong>Показать полностью</strong>
        </a>
    </div>
    <div class="panel-footer">

    </div>
</div>