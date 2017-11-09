<?php

namespace DataSource\Repositories;


use DataSource\DataProviderInterface;
use DataSource\Entities\ArticleEntityInterface;
use DataSource\Services\HttpTransportInterface;

class ArticleHttpRepository implements OutsideArticleRepositoryInterface
{
    protected $httTransport;
    protected $dataProvider;

    public function __construct(HttpTransportInterface $httTransport, DataProviderInterface $dataProvider)
    {
        $this->httTransport = $httTransport;
        $this->dataProvider = $dataProvider;
    }

    public function findByOutsideUrl(string $url): ArticleEntityInterface
    {
        $response = $this->httTransport->get($url);

        if ($response->getCode() <> 200) {
            throw new \Exception('Invalid content', 2100);
        }

        return $this->dataProvider->getArticleByContent($response->getContent());
    }
}