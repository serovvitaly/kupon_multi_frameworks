<?php

namespace DataSource\Services;


class ContentService
{
    public function getBaseContent2()
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


    public function getBaseContent()
    {
        $items = \App\Models\DocumentModel::where('ribbon_id', 5)->get();

        /** @var \App\Models\DocumentModel $rssItemEntity */
        foreach ($items as $rssItemEntity) {
            $metaData = json_decode($rssItemEntity->meta_data);
            yield new \DataSource\Entities\ArticleEntity(
                $rssItemEntity->title,
                new \DateTime($metaData->pub_date->date),
                '',
                $rssItemEntity->getUrl()
            );
        }
    }
}