<?php

namespace App\DataProviders;

use DataSource\DataProviderInterface;
use DataSource\Entities\ArticleEntity;
use DataSource\Entities\ArticleEntityInterface;
use Symfony\Component\DomCrawler\Crawler;

class VoennoeRfDataProvider implements DataProviderInterface
{

    public function getArticleByContent(string $content): ArticleEntityInterface
    {
        $crawler = new Crawler($content);
        //$crawler->addHtmlContent($content, 'utf-8');

        $title = $crawler->filterXPath('//h1[@itemprop="headline"]')->text();
        $pubDate = $crawler->filterXPath('//time[@itemprop="datePublished"]')->attr('datetime');
        $description = '';
        $content = $crawler->filterXPath('//div[@itemprop="articleBody"]')->html();

        return new ArticleEntity($title, new \DateTime($pubDate), $description, $content);
    }
}