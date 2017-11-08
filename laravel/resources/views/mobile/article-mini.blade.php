<div id="post-item-{{ $article_id }}" class="col-lg-12 post-mini">
    <div class="media-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if ($ribbon_logo_url)
                <img
                    class="ribbon-icon"
                    alt="64x64"
                    src="{{ $ribbon_logo_url }}"
                >
                @endif
                <strong style="padding-left: 5px;">{{ $ribbon_title }}</strong>
            </div>
            <div class="panel-body">
                <h3 class="media-heading title">{{ $article_title }}</h3>
                @if ($article_image_url)
                <img alt="{{ $article_title }}" src="{{ $article_image_url }}" style="margin-bottom: 10px;">
                @endif
                <div class="small panel-content">{!! $article_annotation !!}</div>
                <a
                    class="btn btn-primary btn-sm btn-block"
                    href="{{ $article_url }}?from=index"
                    onclick="return showModal('{{ $article_id }}');"
                >
                    <strong>Показать полностью</strong>
                </a>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
</div>