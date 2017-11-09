<?php

namespace DataSource\Entities;


class ArticleEntity implements ArticleEntityInterface
{
    protected $title;
    protected $pubDate;
    protected $description;
    protected $content;

    /**
     * ArticleEntity constructor.
     * @param string $title - заголовок статьи
     * @param \DateTime $pubDate - дата публикации статьи
     * @param string $description - краткое описание статьи
     * @param string $content - содержимое статьи
     */
    public function __construct(string $title, \DateTime $pubDate, string $description, string $content)
    {
        $this->title = trim($title);
        $this->pubDate = $pubDate;
        $this->description = trim($description);
        $this->content = trim($content);
    }

    /**
     * Возвращает заголовок статьи
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Возвращает дату публикации статьи
     * @return \DateTime
     */
    public function getPubDate(): \DateTime
    {
        return $this->pubDate;
    }

    /**
     * Возвращает краткое описание статьи
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Возвращает содержимое статьи
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}