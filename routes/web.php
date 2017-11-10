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
use Jenssegers\Agent\Agent;

$agent = new Agent();

$templatesDir = 'default2';
if ($agent->isMobile()) {
    $templatesDir = 'mobile';
}

if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', $templatesDir);
}

Route::get('/', function () {
    return view(TEMPLATES_DIR . '.index', [
        'showMetric' => !env('APP_DEBUG')
    ]);
});

/**
 * Вывод статьи по указанному идентификатору, вариант AJAX
 */
Route::get('/page/{pageId}/', function (int $pageId) {

    $contentService = new \DataSource\Services\ContentService;
    $documents = $contentService->getBaseContent();

    $itemsArrAsHtml = [];
    /**
     * @var \DataSource\Entities\ArticleEntityInterface $document
     */
    foreach ($documents as $document) {
        $viewData = [
            'article_id' => '',
            'ribbon_logo_url' => '',
            'ribbon_title' => '',
            'article_title' => $document->getTitle(),
            'article_image_url' => '',
            'article_url' => $document->getContent(),
            'article_annotation' => $document->getDescription(),
        ];
        $itemsArrAsHtml[] = view(TEMPLATES_DIR . '.article-mini', $viewData)->render();
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
    /**
     * @var \App\Models\DocumentModel $document
     * @var \App\Models\RibbonModel $ribbon
     */
    $document = \App\Models\DocumentModel::findOrFail($postId);
    $pageHtml = view(TEMPLATES_DIR . '.article', array(
        'article_id' => $postId,
        'title' => $document->title,
        'content' => $document->getCleanContent(),
        'source_url' => \App\UrlHelper::idnToUtf8($document->getSourceUrl()),
        'source_base_url' => $document->getSourceBaseUrl(),
        'url' => 'http://zalipay.com' . $document->getUrl(),
        'image' => '',
        'showMetric' => !env('APP_DEBUG'),
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
    $pageHtml = view(TEMPLATES_DIR . '.article', [
        'title' => $document->title,
        'content' => $document->content,
        'source_url' => \App\UrlHelper::idnToUtf8($document->getSourceUrl()),
        'source_base_url' => $document->getSourceBaseUrl(),
    ])->render();

    return [
        'title' => $document->title,
        'html' => $pageHtml,
        'ribbon_icon' => $ribbon->getLogoUrl(),
        'ribbon_title' => $ribbon->title,
    ];
});
