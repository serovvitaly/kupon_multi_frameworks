<?php

namespace DataSource\Entities;


interface RssItemEntityInterface
{
    /**
     * Возвращает ссылку
     * @return string
     */
    public function getLink(): string;

    /**
     * Возвращает заголовок
     * @return string
     */
    public function getTitle(): string;

    /**
     * Возвращает дату публикации
     * @return \DateTime
     */
    public function getPubDate(): \DateTime;

    /**
     * Возвращает краткое описание
     * @return string
     */
    public function getDescription(): string;
}