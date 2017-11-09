<?php

namespace DataSource;

use DataSource\Entities\ArticleEntityInterface;

interface DataProviderInterface
{
    public function getArticleByContent(string $content): ArticleEntityInterface;
}