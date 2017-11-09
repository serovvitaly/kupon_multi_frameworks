<?php

namespace DataSource\Entities;

class RssItemEntity
{
    protected $link;
    protected $title;
    protected $pubDate;
    protected $description;

    /**
     * RssItemEntity constructor.
     * @param string $link - ссылка
     * @param string $title - заголовок
     * @param \DateTime $pubDate - дата публикации
     * @param string $description - краткое описание
     */
    public function __construct(string $link, string $title, \DateTime $pubDate, string $description)
    {
        $this->link = trim($link);
        $this->title = trim($title);
        $this->pubDate = $pubDate;
        $this->description = trim($description);
    }

    /**
     * Возвращает ссылку
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * Возвращает заголовок
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Возвращает дату публикации
     * @return \DateTime
     */
    public function getPubDate(): \DateTime
    {
        return $this->pubDate;
    }

    /**
     * Возвращает краткое описание
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
