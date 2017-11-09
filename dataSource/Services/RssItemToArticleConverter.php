<?php

namespace DataSource\Services;

use DataSource\DataProviderInterface;
use DataSource\Entities\ArticleEntityInterface;
use DataSource\Entities\RssItemEntityInterface;
use DataSource\Repositories\ArticleHttpRepository;
use DataSource\Repositories\RssRepository;

class RssItemToArticleConverter
{
    /**
     * Преобразует элемент RSS фида в сущность Статьи
     * @param RssItemEntityInterface $rssItemEntity
     * @param HttpTransportInterface $httTransport
     * @param DataProviderInterface $dataProvider
     * @return ArticleEntityInterface
     */
    public function convertRssItemToOutsideArticle(
        RssItemEntityInterface $rssItemEntity,
        HttpTransportInterface $httTransport,
        DataProviderInterface $dataProvider
    ): ArticleEntityInterface
    {
        $repository = new ArticleHttpRepository($httTransport, $dataProvider);
        return $repository->findByOutsideUrl($rssItemEntity->getLink());
    }

    /**
     * Парсит RSS, проебразует полученный результат в сущность Статьи и  сохраняет её в хранилище
     * @param string $url
     * @param HttpTransportInterface $httTransport
     * @param DataProviderInterface $dataProvider
     * @return void
     */
    public function parseRssAndStoreArticlesByRssUrl(
        string $url,
        HttpTransportInterface $httTransport,
        DataProviderInterface $dataProvider
    ): void
    {
        $repository = new RssRepository;
        $items = $repository->findByUrl($url);

        /** @var RssItemEntityInterface $rssItemEntity */
        foreach ($items as $rssItemEntity) {
            echo $rssItemEntity->getLink(), PHP_EOL;
            try {
                $articleEntity = $this->convertRssItemToOutsideArticle($rssItemEntity, $httTransport, $dataProvider);
            } catch (\Exception $e) {
                // todo: Нужно логирование
                continue;
            }
        }
    }
}