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

$templatesDir = 'default';
if ($agent->isMobile()) {
    $templatesDir = 'mobile';
}

if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', $templatesDir);
}

Route::get('sitemap.xml', function () {

    $documents = \App\Models\DocumentModel::where('is_active', true)->get();

    $xml = new \DOMDocument('1.0', 'UTF-8');
    $urlSet = $xml->createElement('urlset');
    $urlSet->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');


    /** @var \App\Models\DocumentModel $document */
    foreach ($documents as $document) {
        $metaData = json_decode($document->meta_data);
        if (isset($metaData->pub_date)) {
            $pubDate = new \DateTime($metaData->pub_date->date);
        } else {
            $pubDate = new \DateTime();
        }
        $loc = 'http://www.zalipay.com' . $document->getEscapedFragmentUrl() . '&amp;from=sm';
        $url = $xml->createElement('url');
        $url->appendChild($xml->createElement('loc', $loc));
        $url->appendChild($xml->createElement('lastmod', $pubDate->format('Y-m-d')));
        $url->appendChild($xml->createElement('priority', 0.8));
        $url->appendChild($xml->createElement('changefreq', 'monthly'));
        $urlSet->appendChild($url);
    }

    $xml->appendChild($urlSet);

    return response($xml->saveXml(), 200)
               ->header('Content-Type', 'text/xml');
});

Route::get('/', function () {

    $documents = \App\Models\DocumentModel::where('is_active', true)
        ->orderBy('published_at', 'desc')
        ->paginate(20);

    return view(TEMPLATES_DIR . '.index', [
        'showMetric' => !env('APP_DEBUG'),
        'documents' => $documents,
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
Route::get('/post/{postId?}/', function (int $postId = 0, Illuminate\Http\Request $request) {

    if ($postId > 0) {
        $document = \App\Models\DocumentModel::findOrFail($postId);
        $redirectUrl = $document->getUrl();
        $from = $request->get('from');
        if (!empty($from)) {
            $redirectUrl .= '&from=' . $from;
        }
        return redirect($redirectUrl);
    }

    $postId = (int)$request->get('_escaped_fragment_', $postId);

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
