<?php

namespace Tests\Unit\DataSource\Repositories;

use Tests\TestCase;

class RssRepositoryTest extends TestCase
{
    public function testFindByUrl()
    {
        $repository = new \DataSource\Repositories\RssRepository;

        $items = $repository->findByUrl('http://xn--b1aga5aadd.xn--p1ai/rss/news.php');

        /** @var \DataSource\Entities\RssItemEntity $item */
        foreach ($items as $item) {
            //
        }

        $this->assertTrue(true);
    }
}
