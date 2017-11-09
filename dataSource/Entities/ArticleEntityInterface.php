<?php

namespace DataSource\Entities;


interface ArticleEntityInterface
{
    /**
     * Возвращает заголовок статьи
     * @return string
     */
    public function getTitle(): string;

    /**
     * Возвращает дату публикации статьи
     * @return \DateTime
     */
    public function getPubDate(): \DateTime;

    /**
     * Возвращает краткое описание статьи
     * @return string
     */
    public function getDescription(): string;

    /**
     * Возвращает содержимое статьи
     * @return string
     */
    public function getContent(): string;
}