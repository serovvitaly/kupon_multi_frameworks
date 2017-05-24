<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('default.index');
});

/**
 * Вывод статьи по указанному идентификатору, вариант AJAX
 */
Route::get('/page/{pageId}/', function (int $pageId) {

    $docsOnPage = 12;
    $skip = ($pageId - 1) * $docsOnPage;

    $documents = \App\Models\DocumentModel::skip($skip)->take($docsOnPage)->get();

    $itemsArrAsHtml = [];
    /**
     * @var \App\Models\DocumentModel $document
     * @var \App\Models\RibbonModel $ribbon
     */
    foreach ($documents as $document) {
        $ribbon = \App\Models\RibbonModel::find($document->ribbon_id);
        $viewData = [
            'article_id' => $document->id,
            'ribbon_logo_url' => $ribbon->getLogoUrl(),
            'ribbon_title' => $ribbon->title,
            'article_title' => $document->title,
            'article_image_url' => '',
            'article_url' => '',
            'article_annotation' => $document->getAnnotation(),
        ];
        $itemsArrAsHtml[] = view('default.article-mini', $viewData)->render();
    }

    return [
        'success' => true,
        'page' => $pageId,
        'items' => $itemsArrAsHtml,
    ];
});

/**
 * Вывод статьи по указанному идентификатору
 */
Route::get('/post/{postId}/', function (int $postId) {
    $document = \App\Models\DocumentModel::findOrFail($postId);
    $pageHtml = view('default.index', array(
        'article_id' => $postId,
        'title' => $document->title,
        'url' => 'http://zalipay.com/post/' . $postId . '/',
        'image' => '',
    ));

    return $pageHtml;
});

/**
 * Вывод статьи по указанному идентификатору
 */
Route::get('/ajax/post/{postId}/', function (int $postId) {
    /**
     * @var \App\Models\DocumentModel $document
     * @var \App\Models\RibbonModel $ribbon
     */
    $document = \App\Models\DocumentModel::findOrFail($postId);
    $ribbon = \App\Models\RibbonModel::findOrFail($document->ribbon_id);
    $pageHtml = view('default.article', [
        'title' => $document->title,
        'content' => $document->content,
        'source_url' => $document->getSourceUrl(),
        'source_base_url' => $document->getSourceBaseUrl(),
    ])->render();

    return [
        'title' => $document->title,
        'html' => $pageHtml,
        'ribbon_icon' => $ribbon->getLogoUrl(),
        'ribbon_title' => $ribbon->title,
    ];
});