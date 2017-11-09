<?php

namespace DataSource\Repositories;

class RssRepository implements RssRepositoryInterface
{
    public function findByUrl(string $url)
    {
        $xml = simplexml_load_file($url);
        foreach ($xml->channel->item as $item) {
            yield new \DataSource\Entities\RssItemEntity(
                $item->link,
                $item->title,
                new \DateTime($item->pubDate),
                $item->description
            );
        }
    }
}
