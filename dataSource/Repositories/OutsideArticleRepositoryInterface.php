<?php

namespace DataSource\Repositories;

use DataSource\Entities\ArticleEntityInterface;

/**
 * Интерфейс репозитория для внешних статей
 * @package DataSource\Repositories
 */
interface OutsideArticleRepositoryInterface
{
    public function findByOutsideUrl(string $url): ArticleEntityInterface;
}