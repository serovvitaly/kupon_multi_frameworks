<?php

namespace DataSource\Services;


class ContentService
{
    public function getBaseContent()
    {
        $rssUrl = 'http://xn--b1aga5aadd.xn--p1ai/rss/news.php';
        $httTransport = new \App\Services\CurlHttpTransport;
        $dataProvider = new \App\DataProviders\VoennoeRfDataProvider;

        $repository = new \DataSource\Repositories\RssRepository;
        $items = $repository->findByUrl($rssUrl);

        $service = new \DataSource\Services\RssItemToArticleConverter;

        /** @var \DataSource\Entities\RssItemEntityInterface $rssItemEntity */
        foreach ($items as $rssItemEntity) {
            try {
                yield $service->convertRssItemToOutsideArticle($rssItemEntity, $httTransport, $dataProvider);
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}