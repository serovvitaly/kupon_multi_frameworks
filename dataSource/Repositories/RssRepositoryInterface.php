<?php

namespace DataSource\Repositories;


interface RssRepositoryInterface
{
    public function findByUrl(string $url);
}