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

Route::get('/page/{pageId}/', function ($pageId) {

    $documents = \App\Models\DocumentModel::all()->take(12);

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
