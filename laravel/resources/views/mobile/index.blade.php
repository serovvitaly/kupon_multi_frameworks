@extends('mobile.layout')

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
        <div class="row">
            <div class="col-lg-4" id="mc-column-1"></div>
            <div class="col-lg-4" id="mc-column-2"></div>
            <div class="col-lg-4" id="mc-column-3"></div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-2">
                <button onclick="loadPosts();" class="btn btn-primary btn-block">
                    <strong>Загрузить ещё</strong>
                </button>
            </div>
            <div class="col-lg-5"></div>
        </div>
    </div>
</div>
@include('default.post-modal')
<script>
var currentPageNumber = 1;
function appendItemToColumn(itemHtml) {
    var columnIndex = 1;
    var colHeight1 = $('#mc-column-1').height(),
        colHeight2 = $('#mc-column-2').height(),
        colHeight3 = $('#mc-column-3').height();
    var minHeight = Math.min(colHeight1, colHeight2, colHeight3);
    var cls = {};
    cls[colHeight1] = 1;
    cls[colHeight2] = 2;
    cls[colHeight3] = 3;
    $('#mc-column-'+cls[minHeight]).append(itemHtml);
}
function loadPosts() {
    $.ajax({
        'url': '/page/' + currentPageNumber + '/',
        'type': 'get',
        'dataType': 'json',
        'success': function(response){
            if(response.items.length < 1){
                return;
            }
            $.each(response.items, function (index, itemHtml) {
                appendItemToColumn(itemHtml);
            });
            currentPageNumber += 1;
        }
    })
}
$(function () {
    loadPosts();
});
</script>
@endsection